<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request, Post $post)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'comment' => 'required',
        ]);
        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);

        return redirect()->to(url()->previous() . '#comment-section');
    }
}
