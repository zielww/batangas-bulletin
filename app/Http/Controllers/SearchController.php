<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $articles = Article::where('title', 'LIKE', '%'.request('search').'%')->get();

        $featuredArticles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(1)
            ->get();

        $trendingNow = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(3)
            ->get();

        $categories = Category::withCount('articles')->get();

        return view('blog.index', [
            'articles' => $articles,
            'categories' => $categories,
            'featuredArticles' => $featuredArticles,
            'trendingNow' => $trendingNow,
            'search' => request('search')
        ]);
    }
}
