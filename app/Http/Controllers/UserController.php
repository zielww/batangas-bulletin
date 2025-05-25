<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authors($id)
    {
        $author = User::find($id);
        if (!$author->is_admin) {
            return redirect('/');
        }

        $articles = Article::with(['category'])
            ->where('status', 'published')
            ->where('user_id', $author->id)
            ->latest('published_at')
            ->simplePaginate(3);

        $categories = Category::whereHas('articles', function ($query) use ($author) {
            $query->where('user_id', $author->id);
        })->get();

        return view('blog.author', compact('author', 'categories', 'articles'));
    }
}
