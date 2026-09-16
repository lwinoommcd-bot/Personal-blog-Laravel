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
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }
        
        $request->validate([
            'comment' => 'required',
        ]);

        $newComment = Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);

        // User ပုံနဲ့ နာမည်ပါအောင် relationship နဲ့ တကွ ပြန်ထုတ်ပေးခြင်း
        $newComment->load('user');

        // စုစုပေါင်း comment အရေအတွက်
        $commentCount = $post->comments()->count();

        return response()->json([
            'success' => true,
            'comment' => $newComment,
            'commentCount' => $commentCount
        ]);
    }
}