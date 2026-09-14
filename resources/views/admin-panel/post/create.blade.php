@extends('admin-panel.master')
@section('title', 'post create')
@section('content')
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 space-y-6">
        <div class="flex justify-between items-center border-b border-slate-100 pb-4">
            <h2 class="text-xl font-bold text-slate-900">Create New Post</h2>
            <a href="{{ url('admin/posts') }}"
                class="text-sm font-medium text-slate-500 hover:text-slate-800 transition">Back</a>
        </div>

        <form action="{{ url('admin/posts') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <!-- Title -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter post title..."
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-indigo-600 transition">
            </div>
            @error('title')
                <span class="text-red-400"><small>{{ $message }}</small></span>
            @enderror

            <!-- Category Selection (Foreign Key) -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Category</label>
                <select name="category_id"
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-indigo-600 transition">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <span class="text-red-400"><small>{{ $message }}</small></span>
            @enderror

            <!-- Image Upload -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Post Image</label>
                <input type="file" name="image"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition">
            </div>
            @error('image')
                <span class="text-red-400"><small>{{ $message }}</small></span>
            @enderror


            <!-- Content -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Content</label>
                <textarea name="contents" rows="6" placeholder="Write your post content here..."
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-indigo-600 transition">{{ old('contents') }}</textarea>
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
                    Save Post
                </button>
            </div>
        </form>
    </div>
@endsection