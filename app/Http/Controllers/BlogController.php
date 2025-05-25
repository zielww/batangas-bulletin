<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __invoke(): View
    {
        // Normal Articles
        $articles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(4);

        // Featured articles
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

        return view('blog.index', compact('articles', 'trendingNow', 'featuredArticles', 'categories'));
    }
}
