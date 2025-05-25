<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index(Request $request) {
        $query = Announcement::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', '%'. $search . '%');
        }

        return $query->get();
    }

    public function show($id) {
        $announcement = Announcement::find($id);
        return response()->json($announcement);
    }

    public function store(Request $request) {
        try {
            $announcement = new Announcement();
            $announcement->title = $request->title;
            $announcement->text = $request->text;
            $announcement->image_url = $request->image_url;
            $announcement->date = $request->date;
            $announcement->save();

            return response()->json([
                'announcement' => $announcement
            ], 201);
        } catch(\Exception $e) {
            return response()->json([
                'eror' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }

        $announcement->update($request->all());

        return response()->json([
            'announcement' => $announcement
        ], 200);
    }

    public function destroy($id) {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }

        $announcement->delete();

        return response()->json([
            'message' => 'Announcement deleted successfully'
        ]);
    }
}
