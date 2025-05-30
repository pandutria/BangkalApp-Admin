<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LetterType;
use Exception;

class LetterTypeController extends Controller
{
    public function index(Request $request) {
        $query = LetterType::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', '%'. $search . '%');
        }

        return $query->get();
    }

    public function show($id) {
        $letterType = LetterType::find($id);
        return response()->json($letterType);
    }

    public function store(Request $request) {
        try {
            $letterType = new LetterType();
            $letterType->name = $request->name;
            $letterType->description = $request->description;
            $letterType->image_url = $request->image_url;
            $letterType->save();

            return response()->json([
                'LetterType' => $letterType
            ], 201);
        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        $letterType = LetterType::find($id);

        if (!$letterType) {
            return response()->json(['message' => 'LetterType not found'], 404);
        }

        $letterType->update($request->all());

        return response()->json([
            'LetterType' => $letterType
        ], 200);
    }

    public function destroy($id) {
        $letterType = LetterType::find($id);

        if (!$letterType) {
            return response()->json(['message' => 'Letter Type not found'], 404);
        }

        $letterType->delete();

        return response()->json([
            'message' => 'LetterType deleted successfully'
        ],201);
    }
}
