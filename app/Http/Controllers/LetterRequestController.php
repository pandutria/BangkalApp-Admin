<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LetterRequest;
use App\Models\LetterType;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class LetterRequestController extends Controller
{
    public function index(Request $request) {
    $query = LetterRequest::with(['user', 'letter_type']);

    if ($request->has('search')) {
        $search = $request->input('search');

        $query->whereHas('user', function ($q) use ($search) {
            $q->where('fullname', 'LIKE', '%' . $search . '%');
        });
    }

        return response()->json($query->get());
    }

    public function show($id) {
        $letterRequest = LetterRequest::with(['user', 'letter_type'])->find($id);
        return response()->json($letterRequest);
    }

    public function showByLetterType(Request $request) {
        $letterTypeId = $request->input('letter_type_id');

        $letterRequests = LetterRequest::with(['user', 'letter_type'])
            ->where('letter_type_id', $letterTypeId)
            ->get();

         return response()->json($letterRequests);
    }


    public function showLetterByUser() {
        $user = Auth::user();

        $letterRequest = LetterRequest::with(['user', 'letter_type'])
            ->where('user_id', $user->id)
            ->get();

        return response()->json($letterRequest);
    }

    public function store(Request $request) {
        try {
            $user = Auth::user();

            $letterRequest = new LetterRequest();
            $letterRequest->user_id = $user->id;
            $letterRequest->letter_type_id = $request->letter_type_id;
            $letterRequest->nik = $request->nik;
            $letterRequest->ktp = $request->ktp;
            $letterRequest->no_kk = $request->no_kk;
            $letterRequest->rt = $request->rt;
            $letterRequest->rw = $request->rw;
            $letterRequest->city = $request->city;
            $letterRequest->work = $request->work;
            $letterRequest->purpose = $request->purpose;
            $letterRequest->marriage = $request->marriage;
            $letterRequest->address = $request->address;
            $letterRequest->gender = $request->gender;
            $letterRequest->place_of_birth = $request->place_of_birth;
            $letterRequest->citizenship = $request->citizenship;
            $letterRequest->religion = $request->religion;
            $letterRequest->father_name = $request->father_name;
            $letterRequest->mother_name = $request->mother_name;
            $letterRequest->status = 'pending';
            $letterRequest->save();
            $letterRequest->load(['user', 'letter_type']);

            return response()->json([
                'letterRequest' => $letterRequest
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function approved(Request $request, $id) {
        $validateData = Validator::make($request->all(), [
            "file" => "required"
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'message' => "File harus Diisi!",
            ], 422);
        }

        $letterRequest = LetterRequest::where("uuid", $id)->first();
        $path = Storage::disk("public")->put("letter", $request->file);

        $letterRequest->status = 'approved';
        $letterRequest->file = $path;
        $letterRequest->save();
        $letterRequest->load(['user', 'letter_type']);

        return response()->json([
            'letterRequest' => $letterRequest
        ], 200);
    }

    public function rejected($id) {
        $letterRequest = LetterRequest::find($id);

        $letterRequest->status = 'rejected';
        $letterRequest->save();
        $letterRequest->load(['user', 'letter_type']);

        return response()->json([
            'letterRequest' => $letterRequest
        ], 200);
    }

    public function destroy(Request $request, $id) {
        $letterRequest = LetterRequest::find($id);

        $letterRequest->delete();

        return response()->json([
            'message' => 'LetterRequest deleted successfully'
        ], 200);
    }


    // public function update(Request $request, $id) {
    //     $letterRequest = LetterRequest::find($id);

    //     $letterRequest->update($request->all());

    //     return response()->json([
    //         'LetterRequest' => $letterRequest
    //     ], 200);
    // }
}
