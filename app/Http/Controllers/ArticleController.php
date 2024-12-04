<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::select('id','title', 'content', 'image_path', 'source', 'publication_date')->get();
        
        // Membuat URL lengkap untuk image_path jika gambar disimpan di server
        $articles->map(function($article) {
            $article->image_url = url('storage/'.$article->image_path);  // Pastikan path sesuai dengan tempat penyimpanan gambar
            return $article;
        });

        return response()->json(['data' => $articles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|string',
            'source' => 'nullable|string',
            'publication_date' => 'required|date',
        ]);

        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        return response()->json($article);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }
}
