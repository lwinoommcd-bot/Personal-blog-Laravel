<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\ExperienceCount;
use App\Models\LikesDislike;
use App\Models\Post;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Auth;


class UiController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        $projects = Project::paginate(3);
        $experience = ExperienceCount::first();
        $latestposts = Post::latest()->limit(6)->get();
        return view('ui-panel.index', compact(['skills', 'projects', 'experience', 'latestposts']));
    }

    public function postDetails(Post $post)
    {
        $categories = Category::all();
        $userReaction = LikesDislike::where('post_id', $post->id)
            ->where('user_id', Auth::id())
            ->value('type');

        $userLike = $userReaction === 'like';
        $userDislike = $userReaction === 'dislike';

        $likeCount = $post->likesDislikes()
            ->where('type', 'like')
            ->count();

        $dislikeCount = $post->likesDislikes()
            ->where('type', 'dislike')
            ->count();

        $comments = Comment::where('post_id', $post->id)->where('status', 'show')->with('user')->latest()->get();
        $recentPosts = Post::latest()->take(5)->get();

        return view('ui-panel.post-detail', compact(
            'post',
            'comments',
            'userLike',
            'userDislike',
            'likeCount',
            'dislikeCount',
            'recentPosts',
            'categories'

        ));
    }

    public function postIndex()
    {
        $categories = Category::all();
        $posts = Post::latest()->paginate(4);
        $recentPosts = Post::latest()->take(5)->get();
        return view('ui-panel.posts', compact(['categories', 'posts', 'recentPosts']));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $search_data = $request->search;
        $posts = Post::where('title', 'like', "%" . $search_data . "%")
            ->orWhere('content', 'like', "%" . $search_data . "%")
            ->orWhereHas('category', function ($category) use ($search_data) {
                $category->where('name', 'like', "%" . $search_data . "%");
            })
            ->paginate(4);
        $recentPosts = Post::latest()->take(5)->get();
        return view('ui-panel.posts', compact(['categories', 'posts','recentPosts']));
    }

    public function searchByCategory($id)
    {
        $categories = Category::all();
        $posts = Post::where('category_id', $id)->paginate(5);
        $recentPosts = Post::latest()->take(5)->get();
        return view('ui-panel.posts', compact(['categories', 'posts','recentPosts']));
    }
}
