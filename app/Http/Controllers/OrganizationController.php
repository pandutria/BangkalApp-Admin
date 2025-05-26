<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Exception;

class OrganizationController extends Controller
{
    public function index(Request $request) {
        $query = Organization::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', '%'. $search .'%');
        }

        return $query->orderBy('level')->get();
    }

    public function show($id) {
        $organization = Organization::find($id);
        return response()->json($organization);
    }

    public function store(Request $request) {
        try {
            $organization = new Organization();
            $organization->title = $request->title;
            $organization->description = $request->description;
            $organization->image_url = $request->image_url;
            $organization->level = $request->level;
            $organization->save();

            return response()->json([
                'organization' => $organization
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        $organization = Organization::find($id);

        if (!$organization) {
            return response()->json(['message' => 'Organization not found'], 404);
        }

        $organization->update($request->all());

        return response()->json([
            'organization' => $organization
        ], 200);
    }

    public function destroy($id) {
        $organization = Organization::find($id);

        if (!$organization) {
            return response()->json(['message' => 'Organization not found'], 404);
        }

        $organization->delete();

        return response()->json([
            'message' => 'Potential deleted success'
        ], 200);
    }
}
