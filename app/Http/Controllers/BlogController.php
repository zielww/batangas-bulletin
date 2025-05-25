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
        $articles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(Setting::get('posts_per_page', 10));

        $featuredArticles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(3)
            ->get();

        $categories = Category::withCount('articles')->get();

        return view('blog.index', compact('articles', 'featuredArticles', 'categories'));
    }

    public function show(string $slug): View
    {
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

        return view('blog.show', compact('article', 'relatedArticles'));
    }

    public function category(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(Setting::get('posts_per_page', 10));

        return view('blog.category', compact('articles', 'category'));
    }

    public function storeComment(Request $request, Article $article)
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
            'article_id' => $article->id,
            'status' => Setting::get('moderate_comments', 'true') === 'true' ? 'pending' : 'approved',
        ]);

        $message = Setting::get('moderate_comments', 'true') === 'true'
            ? 'Your comment has been submitted and is awaiting moderation.'
            : 'Your comment has been posted successfully!';

        return back()->with('success', $message);
    }
}
