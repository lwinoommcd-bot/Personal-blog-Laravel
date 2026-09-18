@extends('ui-panel.master')
@section('title', $post->title)
@section('content')

    <div class="max-w-7xl mx-auto  py-2">

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
                <button @click="open = !open"
                    class="w-full flex items-center justify-between text-lg font-bold text-slate-900 tracking-tight focus:outline-none">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Categories
                    </span>
                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
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
            <div class="lg:col-span-8 space-y-8">
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

                    <div class="w-full h-80 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="p-6 md:p-8">

                        <div
                            class="flex flex-wrap items-center gap-4 text-xs md:text-sm text-gray-500 mb-6 pb-4 border-b border-gray-100">
                            <!-- Post Date -->
                            <div class="flex items-center space-x-1.5">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>{{ $post->created_at->format('d F, Y') }}</span>
                            </div>

                            <!-- Author Name -->
                            <div class="flex items-center space-x-1.5">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ $post->user->name ?? 'Owner' }}</span>
                            </div>

                            <!-- Category -->
                            <div class="flex items-center space-x-1.5">
                                <span class="bg-indigo-50 text-indigo-700 font-semibold px-2.5 py-1 rounded-full text-xs">
                                    {{ $post->category->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </div>

                        <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 leading-snug">
                            {{ $post->title }}
                        </h2>

                        <p class="text-gray-600 text-base leading-relaxed text-justify mb-8">
                            {{ $post->content }}
                        </p>

                        <!-- Like & Dislike Buttons Container -->
                        <div id="like-section" class="flex items-center gap-3 mb-8 pt-4 border-t border-slate-100">

                            <!-- Like Button -->
                            <button type="button" onclick="handleReaction('{{ url('post/like/' . $post->id) }}')"
                                id="like-btn"
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-sm font-medium transition-all duration-200 shadow-sm {{ $userLike ? 'bg-emerald-600 text-white' : 'bg-slate-50 text-slate-700 border border-slate-200' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
                                    </path>
                                </svg>
                                <span>Like</span>
                                <span id="like-count"
                                    class="text-xs font-semibold px-1.5 py-0.5 rounded-md {{ $userLike ? 'bg-white/25' : 'bg-black/10' }}">{{ $likeCount }}</span>
                            </button>

                            <!-- Dislike Button -->
                            <button type="button" onclick="handleReaction('{{ url('post/dislike/' . $post->id) }}')"
                                id="dislike-btn"
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-sm font-medium transition-all duration-200 shadow-sm {{ $userDislike ? 'bg-rose-500 text-white' : 'bg-slate-50 text-slate-700 border border-slate-200' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.737 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905.405.905-.904 0-.715-.211-1.413-.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5">
                                    </path>
                                </svg>
                                <span>Dislike</span>
                                <span id="dislike-count"
                                    class="text-xs font-semibold px-1.5 py-0.5 rounded-md {{ $userDislike ? 'bg-white/25' : 'bg-black/10' }}">{{ $dislikeCount }}</span>
                            </button>

                        </div>

                        <!-- Comments Section -->
                        <div id="comment-section" class="space-y-6 pt-4 border-t border-gray-100">

                            <!-- Comment Form -->
                            <form onsubmit="submitComment(event, '{{ url('/post/comments/' . $post->id) }}')"
                                class="space-y-3">
                                @csrf
                                <textarea required rows="3" placeholder="Write a comment..." name="comment"
                                    id="comment-input"
                                    class="w-full p-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm bg-gray-50"></textarea>

                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl text-sm font-medium shadow-sm transition flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    <span>Submit Comment</span>
                                </button>

                                <div
                                    class="text-sm font-medium text-slate-500 bg-slate-50 px-3 py-1.5 rounded-lg inline-block">
                                    <span id="comment-count"
                                        class="font-bold text-slate-800">{{ $post->comments()->count() }}</span> Comments
                                </div>
                            </form>

                            <!-- Comments List Container -->
                            <div id="comments-list" class="space-y-4">
                                @foreach ($comments as $comment)
                                    <div class="space-y-4">
                                        <div class="p-3 bg-gray-50 rounded-2xl border border-gray-100">
                                            <div class="flex items-center space-x-3 mb-2">
                                                <img src="{{ asset('storage/' . $comment->user->image) }}" alt=""
                                                    class="w-8 h-8 rounded-full bg-gray-200 object-cover">
                                                <span
                                                    class="font-semibold text-gray-800 text-sm">{{ $comment->user->name }}</span>
                                            </div>
                                            <p class="text-gray-600 text-sm pl-11">{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <!-- MOBILE ONLY: Recent Posts (Detail Page ၏ အောက်ဆုံးတွင် ပေါ်မည်) -->
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
                        @if(isset($recentPosts))
                            @foreach ($recentPosts as $recent)
                                <a href="{{ url('posts/' . $recent->id . '/details') }}"
                                    class="flex items-center gap-4 group p-2 rounded-2xl hover:bg-slate-50 transition-all">
                                    <div
                                        class="w-16 h-16 rounded-2xl overflow-hidden flex-shrink-0 border border-slate-100 shadow-sm">
                                        <img src="{{ asset('storage/' . $recent->image) }}" alt=""
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                    <div class="space-y-1.5 flex-grow">
                                        <span
                                            class="text-[10px] bg-indigo-50 text-indigo-600 border border-indigo-100 px-2 py-0.5 rounded-full font-semibold inline-block">
                                            {{ $recent->category->name ?? 'Uncategorized' }}
                                        </span>
                                        <h6
                                            class="text-xs font-bold text-slate-800 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-relaxed">
                                            {{ $recent->title }}
                                        </h6>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

            <!-- ညာဘက်ခြမ်း: Recent Posts Sidebar (4 Columns) - Laptop မှာသာ ပုံမှန်အတိုင်း ပြမည် -->
            <div class="hidden lg:block lg:col-span-4 space-y-6">
                @include('ui-panel.side-bar')
            </div>
        </div>

        <!-- JavaScript for AJAX -->
        <script>
            function handleReaction(url) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (response.status === 401) {
                            window.location.href = "{{ route('login') }}";
                            return;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.success) {
                            const likeBtn = document.getElementById('like-btn');
                            const likeCount = document.getElementById('like-count');
                            likeCount.innerText = data.likeCount;
                            if (data.userLike) {
                                likeBtn.className = "inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-sm font-medium transition-all duration-200 shadow-sm bg-emerald-600 text-white";
                                likeCount.className = "text-xs font-semibold px-1.5 py-0.5 rounded-md bg-white/25";
                            } else {
                                likeBtn.className = "inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-sm font-medium transition-all duration-200 shadow-sm bg-slate-50 text-slate-700 border border-slate-200";
                                likeCount.className = "text-xs font-semibold px-1.5 py-0.5 rounded-md bg-black/10";
                            }

                            const dislikeBtn = document.getElementById('dislike-btn');
                            const dislikeCount = document.getElementById('dislike-count');
                            dislikeCount.innerText = data.dislikeCount;
                            if (data.userDislike) {
                                dislikeBtn.className = "inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-sm font-medium transition-all duration-200 shadow-sm bg-rose-500 text-white";
                                dislikeCount.className = "text-xs font-semibold px-1.5 py-0.5 rounded-md bg-white/25";
                            } else {
                                dislikeBtn.className = "inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-sm font-medium transition-all duration-200 shadow-sm bg-slate-50 text-slate-700 border border-slate-200";
                                dislikeCount.className = "text-xs font-semibold px-1.5 py-0.5 rounded-md bg-black/10";
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            function submitComment(event, url) {
                event.preventDefault();

                const commentInput = document.getElementById('comment-input');
                const commentText = commentInput.value;

                if (!commentText.trim()) return;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ comment: commentText })
                })
                    .then(response => {
                        if (response.status === 401) {
                            window.location.href = "{{ route('login') }}";
                            return;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.success) {
                            commentInput.value = '';
                            document.getElementById('comment-count').innerText = data.commentCount;

                            const commentsList = document.getElementById('comments-list');
                            const userImage = data.comment.user.image ? "{{ asset('storage/') }}/" + data.comment.user.image : "https://via.placeholder.com/150";

                            const newCommentHTML = `
                                    <div class="space-y-4 animate-fade-in">
                                        <div class="p-3 bg-gray-50 rounded-2xl border border-gray-100">
                                            <div class="flex items-center space-x-3 mb-2">
                                                <img src="${userImage}" alt="" class="w-8 h-8 rounded-full bg-gray-200 object-cover">
                                                <span class="font-semibold text-gray-800 text-sm">${data.comment.user.name}</span>
                                            </div>
                                            <p class="text-gray-600 text-sm pl-11">${data.comment.comment}</p>
                                        </div>
                                    </div>
                                `;

                            commentsList.insertAdjacentHTML('afterbegin', newCommentHTML);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>

    </div>

@endsection