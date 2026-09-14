<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin-panel.post.index', compact('posts'));
    }

    public function showHide($id)
    {
        $comment = Comment::findOrFail($id);
        $commentStatus = $comment->status == 'show' ? 'hide' : 'show';
            $comment->update([
                'status' => $commentStatus,
            ]);
        
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin-panel.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'image' => 'required|image|mimes:png,jpeg,jpg',
            'title' => 'required',
            'contents' => 'required'
        ]);

        $imagePath = $request->file('image')->store('posts', 'public');
        Post::create([
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'title' => $request->title,
            'content' => $request->contents
        ]);

        return redirect()->route('posts.index')->with('successMsg', 'SuccessFull Created..');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();
        return view('admin-panel.post.comment', compact(['comments', 'post']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin-panel.post.edit', compact(['post', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:png,jpeg,jpg',
            'title' => 'required',
            'contents' => 'required'
        ]);

        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->contents
        ];

        if ($request->hasFile('image')) {
            if ($post->image && \Storage::disk('public')->exists($post->image)) {
                \Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('successMsg', 'SuccessFul Updated..');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image && \Storage::disk('public')->exists($post->image)) {
            \Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return back()->with('successMsg', 'SuccessFul Deleted..');
    }
}
