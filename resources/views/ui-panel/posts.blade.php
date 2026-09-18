@extends('ui-panel.master')
@section('title', 'posts')
@section('content')

    <div class="max-w-7xl mx-auto  py-2 ">
        
        <!-- 1. MOBILE ONLY: Search & Dropdown Category (ဖုန်းစခရင်မှာ အပေါ်ဆုံးရောက်မည်) -->
        <div class="block lg:hidden space-y-6 mb-6">
            
            <!-- Search Box Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 space-y-4">
                <h5 class="text-lg font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Search
                </h5>
                <form action="{{ url('/search') }}" method="GET">
                    @csrf
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-slate-400">
                            <i class="fa fa-search text-xs"></i>
                        </span>
                        <input type="text" name="search"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-11 pr-4 py-3 text-sm focus:outline-none focus:border-indigo-600 focus:bg-white text-slate-800 transition-all"
                            placeholder="Search Posts...">
                        <button type="submit"
                            class="absolute right-1.5 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-sm transition">
                            Go
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories Dropdown Card -->
            <div x-data="{ open: false }" class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 space-y-3">
                <button @click="open = !open" class="w-full flex items-center justify-between text-lg font-bold text-slate-900 tracking-tight focus:outline-none">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Categories
                    </span>
                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-transition.origin.top.duration.200ms class="space-y-1 pt-2 border-t border-slate-100">
                    <ul class="space-y-1 text-sm font-medium text-slate-600">
                        @if(isset($categories))
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ url('search_category/' . $category->id) }}"
                                        class="flex items-center justify-between py-2.5 px-3.5 rounded-2xl hover:bg-indigo-50/60 hover:text-indigo-600 font-semibold transition-all group">
                                        <span>{{ $category->name }}</span>
                                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

        </div>

        <!-- 2. DESKTOP & GENERAL GRID LAYOUT -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left Side: Posts List (8 Columns) -->
            <div class="lg:col-span-8 space-y-8">
                @foreach ($posts as $post)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden transition hover:shadow-md">

                        <div class="overflow-hidden max-h-[350px]">
                            <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                class="w-full h-[230px] sm:h-[280px] object-cover transition transform hover:scale-105 duration-300">
                        </div>

                        <div class="p-4 sm:p-6 lg:p-8 space-y-4">

                            <span class="inline-block bg-slate-600 text-white text-xs font-semibold px-3 py-1 rounded-lg">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </span>

                            <h3 class="text-lg sm:text-xl font-bold text-slate-900">
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
                
                <!-- Pagination -->
                <div class="p-2">{{ $posts->links() }}</div>

                <!-- MOBILE ONLY: Recent Posts (Posts List ၏ အောက်ဆုံးတွင် ပေါ်မည်)[cite: 2] -->
                <div class="block lg:hidden bg-white rounded-3xl shadow-sm border border-slate-100 p-6 space-y-4 mt-8">
                    <h5 class="text-lg font-bold text-slate-900 tracking-tight flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Recent Posts
                    </h5>
                    <hr class="border-slate-100">

                    <div class="space-y-4">
                        @foreach ($recentPosts as $post)
                            <a href="{{ url('posts/' . $post->id . '/details') }}"
                                class="flex items-center gap-4 group p-2 rounded-2xl hover:bg-slate-50 transition-all">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden flex-shrink-0 border border-slate-100 shadow-sm">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="space-y-1.5 flex-grow">
                                    <span
                                        class="text-[10px] bg-indigo-50 text-indigo-600 border border-indigo-100 px-2 py-0.5 rounded-full font-semibold inline-block">
                                        {{ $post->category->name }}
                                    </span>
                                    <h6
                                        class="text-xs font-bold text-slate-800 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-relaxed">
                                        {{ $post->title }}
                                    </h6>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Right Side: Sidebar (4 Columns) - Laptop မှာသာ ပုံမှန်အတိုင်း ပြမည် -->
            <div class="hidden lg:block lg:col-span-4 space-y-6">
                @include('ui-panel.side-bar')
            </div>

        </div>
    </div>

@endsection