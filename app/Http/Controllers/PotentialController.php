<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Potential;
use Exception;

class PotentialController extends Controller
{
    public function index(Request $request) {
        $query = Potential::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', '%'. $search .'%');
        }

        return $query->get();
    }

    public function show($id) {
        $potential = Potential::find($id);
        return response()->json($potential);
    }

    public function store(Request $request) {
        try {
            $potential = new Potential();
            $potential->title = $request->title;
            $potential->description = $request->description;
            $potential->image_url = $request->image_url;
            $potential->save();

            return response()->json([
                'potential' => $potential
            ], 201);

        } catch(Exception $e) {
            return response()->json([
                'error'=> $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        $potential = Potential::find($id);

        if (!$potential) {
            return response()->json(['message' => 'Potential not found'], 404);
        }

        $potential->update($request->all());

        return response()->json([
            'potential' => $potential
        ], 200);
    }

    public function destroy($id) {
        $potential = Potential::find($id);

        if (!$potential) {
            return response()->json(['message' => 'Potential not found'],404);
        }

        $potential->delete();

        return response()->json([
            'message' => 'Potential deleted success'
        ], 200);
    }
}
