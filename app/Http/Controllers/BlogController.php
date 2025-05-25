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
    public function index(): View
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

    public function show(string $slug): View
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

    public function category(string $slug): View
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

    public function storeComment(Request $request, $article)
    {
        if (!Setting::get('allow_comments', 'true')) {
            return back()->with('error', 'Comments are currently disabled.');
        }

        $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $request->content,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'article_id' => $article,
            'status' => Setting::get('moderate_comments', 'true') === 'true' ? 'pending' : 'approved',
        ]);

        $message = Setting::get('moderate_comments', 'true') === 'true'
            ? 'Your comment has been submitted and is awaiting moderation.'
            : 'Your comment has been posted successfully!';

        return back()->with('success', $message);
    }
}
