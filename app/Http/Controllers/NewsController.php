<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request) {
        $query = News::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', '%'. $search . '%');
        }

        return $query->get();
    }

    public function show($id) {
        $news = News::find($id);
        return response()->json($news);
    }

    public function store(Request $request) {
        try {
            $news = new News();
            $news->title = $request->title;
            $news->text = $request->text;
            $news->url = $request->url;
            $news->image_url = $request->image_url;
            $news->date = $request->date;
            $news->save();

            return response()->json([
                'news' => $news
            ], 201);
        } catch(\Exception $e) {
            return response()->json([
                'eror' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $news->update($request->all());

        return response()->json([
            'news' => $news
        ],200);
    }

    public function destroy($id) {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $news->delete();

        return response()->json([
            'message' => 'News deleted successfully'
        ], 200);
    }
}
