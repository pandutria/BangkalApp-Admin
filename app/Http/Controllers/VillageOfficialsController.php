<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VillageOfficials;
use Exception;

class VillageOfficialsController extends Controller
{
    public function index(Request $request) {
        $query = VillageOfficials::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', '%'. $search .'%');
        }

         return $query->with('organization')->get();
    }

    public function show($id) {
        $village = VillageOfficials::find($id);
        return response()->json($village);
    }

    public function store(Request $request) {
        try {
            $village = new VillageOfficials();
            $village->organization_id = $request->organization_id;
            $village->name = $request->name;
            $village->contact = $request->contact;
            $village->image_url = $request->image_url;
            $village->save();
            $village->load('organization');

            return response()->json([
                'village' => $village
            ], 201);

        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        $village = VillageOfficials::find($id);

        if (!$village) {
            return response()->json(['message' => 'Village not found'], 404);
        }

        $village->update($request->all());
        $village->load('organization');

        return response()->json([
            'village' => $village
        ], 200);
    }

    public function destroy($id) {
        $village = VillageOfficials::find($id);

        if (!$village) {
            return response()->json(['message' => 'Village not found'], 404);
        }

        $village->delete();

        return response()->json([
            'message' => 'Village deleted success'
        ], 200);
    }
}
