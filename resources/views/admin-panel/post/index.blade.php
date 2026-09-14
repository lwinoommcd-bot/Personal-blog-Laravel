@extends('admin-panel.master')
@section('title', 'post')
@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-6 max-w-7xl mx-auto">
        @if (session('successMsg'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
                class="mb-6 max-w-3xl flex items-center justify-between bg-green-50 border border-green-200 text-green-800 px-5 py-3.5 rounded-xl shadow-sm">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('successMsg') }}</span>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-900 focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endif
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-slate-900">Manage Posts</h2>
            <a href="{{ url('admin/posts/create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl transition shadow-sm inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Post
            </a>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4">Image</th>
                        <th class="py-3 px-4">Title</th>
                        <th class="py-3 px-4">Content</th>
                        <th class="py-3 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="hover:bg-slate-50/50 transition border-b border-slate-50">
                            <td class="py-4 px-4 font-medium text-slate-900">{{$loop->iteration }}</td>
                            <td class="py-4 px-4 font-semibold text-slate-800 whitespace-nowrap">
                                {{ $post->category->name }}
                            </td>
                            <td class="py-4 px-4">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="No Image"
                                    class="w-16 h-12 object-cover text-sm rounded-xl border border-slate-200">
                            </td>
                            <td class="py-4 px-4 text-sm text-slate-900 max-w-xs">
                                {{ $post->title }}
                            </td>
                            <td class="py-4 px-4 text-slate-500 text-xs max-w-sm truncate">
                                {{ $post->content }}
                            </td>
                            <td class="py-4 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium text-xs bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-rose-600 hover:text-rose-800 font-medium text-xs bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition"
                                            onclick="return confirm('Are you sure you want to delete this post?');">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{ url('admin/posts/'.$post->id) }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium text-xs bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition">
                                        Comments
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pt-2">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection