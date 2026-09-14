@extends('ui-panel.master')
@section('title', 'posts')
@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Side: Posts List (8 Columns) -->
            <div class="lg:col-span-8 space-y-8 ">
                @foreach ($posts as $post)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden transition hover:shadow-md">

                        <div class="overflow-hidden max-h-[350px]">
                            <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                class="w-full h-[280px] object-cover transition transform hover:scale-105 duration-300">
                        </div>

                        <div class="p-6 sm:p-8 space-y-4">

                            <span class="inline-block bg-slate-600 text-white text-xs font-semibold px-3 py-1 rounded-lg">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </span>

                            <h3 class="text-xl font-bold text-slate-900">
                                {{ $post->title }}
                            </h3>

                            <p class="text-slate-600 text-sm leading-relaxed">
                                {{ $post->content }}
                            </p>

                            <div>
                                <a href="{{ url('posts/' . $post->id . '/details') }}"
                                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition shadow-sm">
                                    See More <i class="fas fa-angle-double-right"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
                <div class="p-2">{{ $posts->links() }}</div>
            </div>



            <!-- Right Side: Sidebar (4 Columns) -->
            <div class="lg:col-span-4 space-y-6">
                @include('ui-panel.side-bar')
            </div>

        </div>
    </div>

@endsection