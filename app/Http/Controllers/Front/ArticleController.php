<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        // Ambil 3 artikel terbaru untuk rekomendasi bacaan lain (kecuali artikel yang sedang dibaca)
        $relatedArticles = Article::where('id', '!=', $article->id)->latest()->take(3)->get();
        return view('articles.show', compact('article', 'relatedArticles'));
    }
}