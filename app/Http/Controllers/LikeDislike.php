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
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $reaction = LikesDislike::where('post_id', $postId)
            ->where('user_id', Auth::id())
            ->first();

        if ($reaction && $reaction->type === 'like') {
            $reaction->delete();
        } else {
            LikesDislike::updateOrCreate(
                ['post_id' => $postId, 'user_id' => Auth::id()],
                ['type' => 'like']
            );
        }

        // လက်ရှိ post ရဲ့ like နဲ့ dislike အရေအတွက် အသစ်ကို တွက်ချက်ခြင်း
        $likeCount = LikesDislike::where('post_id', $postId)->where('type', 'like')->count();
        $dislikeCount = LikesDislike::where('post_id', $postId)->where('type', 'dislike')->count();

        // ကိုယ်တိုင် like လုပ်ထားခြင်း ရှိမရှိ စစ်ဆေးရန်
        $userLike = LikesDislike::where('post_id', $postId)->where('user_id', Auth::id())->where('type', 'like')->exists();
        $userDislike = LikesDislike::where('post_id', $postId)->where('user_id', Auth::id())->where('type', 'dislike')->exists();

        return response()->json([
            'success' => true,
            'likeCount' => $likeCount,
            'dislikeCount' => $dislikeCount,
            'userLike' => $userLike,
            'userDislike' => $userDislike,
        ]);
    }
    public function dislike($postId)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
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

        // Like နဲ့ Dislike အရေအတွက်နဲ့ အခြေအနေများကို ပြန်လည်တွက်ချက်ခြင်း
        $likeCount = LikesDislike::where('post_id', $postId)->where('type', 'like')->count();
        $dislikeCount = LikesDislike::where('post_id', $postId)->where('type', 'dislike')->count();

        $userLike = LikesDislike::where('post_id', $postId)->where('user_id', Auth::id())->where('type', 'like')->exists();
        $userDislike = LikesDislike::where('post_id', $postId)->where('user_id', Auth::id())->where('type', 'dislike')->exists();

        return response()->json([
            'success' => true,
            'likeCount' => $likeCount,
            'dislikeCount' => $dislikeCount,
            'userLike' => $userLike,
            'userDislike' => $userDislike,
        ]);
    }


}
