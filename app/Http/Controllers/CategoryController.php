<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(5);

        // Featured article
        $featuredArticle = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->limit(1)
            ->get();

        $trendingArticles = Article::with('category')
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->limit(5)
            ->get();

        return view('blog.category', compact('articles','trendingArticles', 'featuredArticle', 'category'));
    }
}
