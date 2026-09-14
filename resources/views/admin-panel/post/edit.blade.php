@extends('admin-panel.master')
@section('title', 'post edit')
@section('content')
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 space-y-6">
        <div class="flex justify-between items-center border-b border-slate-100 pb-4">
            <h2 class="text-xl font-bold text-slate-900">Edit Post</h2>
            <a href="{{ url('admin/posts') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition">Back</a>
        </div>

        <form action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf 
            @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Post Title</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" 
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-600 transition">
            </div>
            @error('title')
                <span class="text-red-400"><small>{{ $message }}</small></span>
            @enderror

            <!-- Category Selection -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Category</label>
                <select name="category_id" 
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-indigo-600 transition">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id',$post->category_id) == $category->id ? 'selected' : ''  }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <span class="text-red-400"><small>{{ $message }}</small></span>
            @enderror

            <!-- Image Preview & Update -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Post Image</label>
                @if ($post->image)         
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image"
                        class="w-32 h-20 object-cover rounded-xl border border-slate-200">
                </div>
                @endif
                <input type="file" name="image"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition">
            </div>

            <!-- Content -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Content</label>
                <textarea name="contents" rows="6" 
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-indigo-600 transition">{{ old('contents',$post->content)}}</textarea>
            </div>
            @error('contents')
                <span class="text-red-400"><small>{{ $message }}</small></span>
            @enderror

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-2">
                <a href="{{ url('admin/posts') }}"
                    class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition shadow-sm">
                    Update Post
                </button>
            </div>
        </form>
    </div>
@endsection