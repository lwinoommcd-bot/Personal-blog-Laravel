@extends('admin-panel.master')
@section('title', 'Manage Posts & Comments')
@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-6 max-w-7xl mx-auto">

        <!-- Header Section  -->
        <div class="flex justify-between items-center border-b border-slate-100 pb-4">
            <h2 class="text-lg font-bold text-slate-800">Comments Management</h2>

            <!-- Back Button -->
            <a href="{{ url('admin/posts') }}"
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-medium bg-slate-100 hover:bg-slate-200 text-slate-700 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                <span>Back to Posts</span>
            </a>
        </div>

        <!-- Comments Table -->
        <div class="overflow-x-auto border border-slate-200 rounded-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-4 w-16 text-center">No.</th>
                        <th class="py-3 px-4"><span class="bg-slate-600 text-white rounded-full p-2 ">Title :
                                {{ $post->title }}</span></th>
                        <th class="py-3 px-4 text-right w-44">Action (Hide / Show)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <!-- Row 1 -->
                    @if ($comments->count() > 0)
                        @foreach ($comments as $comment)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="py-4 px-4 text-center font-medium text-slate-700 text-sm">{{ $loop->iteration }}</td>
                                <td class="py-4 px-4 space-y-1">
                                    <!-- Comment Text -->
                                    <div class="text-sm text-slate-800 font-normal">
                                        {{ $comment->comment }}
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1.5">
                                        <form action="{{ url('admin/comment/' . $comment->id . '/show_hide') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 {{ $comment->status == 'show' ? 'bg-rose-600 hover:bg-rose-700 px-2.5' : 'bg-emerald-600 hover:bg-emerald-700 px-2' }} text-white text-xs font-medium py-1.5 rounded transition shadow-sm">

                                                <!-- SVG Icon  -->
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.8"
                                                    viewBox="0 0 24 24">
                                                    @if($comment->status == 'show')
                                                        <!-- Hide Icon Path -->
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                    @else
                                                        <!-- Show Icon Paths -->
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    @endif
                                                </svg>

                                                {{ $comment->status == 'show' ? 'hide' : 'show' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center py-6 text-slate-500 text-sm">
                                No comment found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection