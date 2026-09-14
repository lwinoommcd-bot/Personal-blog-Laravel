<?php

namespace App\Http\Controllers;

use App\Models\LikesDislike;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class LikeDislike extends Controller
{

    public function like($postId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $reaction = LikesDislike::where('post_id', $postId)
            ->where('user_id', Auth::id())
            ->first();

        if ($reaction && $reaction->type === 'like') {
            $reaction->delete(); // Unlike
        } else {
            LikesDislike::updateOrCreate(
                [
                    'post_id' => $postId,
                    'user_id' => Auth::id(),
                ],
                [
                    'type' => 'like',
                ]
            );
        }

        return redirect()->to(url()->previous() . '#like-section');
    }

    public function dislike($postId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $reaction = LikesDislike::where('post_id', $postId)
            ->where('user_id', Auth::id())
            ->first();

        if ($reaction && $reaction->type === 'dislike') {
            $reaction->delete(); // Undislike
        } else {
            LikesDislike::updateOrCreate(
                [
                    'post_id' => $postId,
                    'user_id' => Auth::id(),
                ],
                [
                    'type' => 'dislike',
                ]
            );
        }

        return redirect()->to(url()->previous() . '#like-section');
    }

    
}
