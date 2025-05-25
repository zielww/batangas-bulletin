<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Setting;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $article)
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
