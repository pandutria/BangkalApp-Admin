<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Exception;

class HistoryController extends Controller
{
    public function index(Request $request) {
        $query = History::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', "LIKE", '%'. $search .'%');
        }

        return $query->get();
    }

    public function show($id) {
        $history = History::find($id);
        return response()->json($history);
    }

    public function store(Request $request) {
        try {
            $history = new History();
            $history->title = $request->title;
            $history->text = $request->text;
            $history->image_url = $request->image_url;
            $history->date = $request->date;
            $history->save();

            return response()->json([
                "history" => $history
            ], 201);

        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        $history = History::find($id);

        if (!$history) {
            return response()->json(['message', 'History not found']);
        }

        $history->update($request->all());

        return response()->json([
            'history' => $history
        ], 200);
    }

    public function destroy($id) {
        $history = History::find($id);

        if (!$history) {
            return response()->json(['message' => 'History Not Found']);
        }

        $history->delete();

        return response()->json([
            'message' => 'Histort deleted successfully'
        ], 200);
    }
}
