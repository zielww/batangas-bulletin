<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __invoke(string $slug): View
    {
        //Get the article to be shown
        $article = Article::with(['category', 'user', 'comments' => function($query) {
            $query->where('status', 'approved')->latest();
        }])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedArticles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        $trendingNow = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(3)
            ->get();

        $comments = Comment::with(['article'])
            ->where('status', 'approved')
            ->where('article_id', $article->id)
            ->latest('created_at')
            ->simplePaginate(3);

        return view('blog.show', compact('article', 'trendingNow', 'comments', 'relatedArticles'));
    }
}
