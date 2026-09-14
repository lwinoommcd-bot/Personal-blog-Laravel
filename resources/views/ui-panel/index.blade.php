@extends('ui-panel.master')
@section('title', 'Home')
@section('content')
  <!-- ABOUT ME & SKILLS SECTION -->
  <section id="about" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- About Me Column (Modern Dark/Gradient Accent Card) -->
    <div
      class="lg:col-span-5 bg-slate-900 text-white p-8 rounded-3xl shadow-xl border border-slate-800 space-y-6 relative overflow-hidden">

      <!-- Background Glow Effect -->
      <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl"></div>

      <h3 class="text-2xl font-bold text-white border-l-4 border-indigo-500 pl-3 relative z-10 tracking-tight">ABOUT ME
      </h3>

      <p class="text-slate-400 text-sm leading-relaxed relative z-10">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat fugiat soluta consectetur reprehenderit
        facere, quis error quidem harum quam laborum inventore quasi minima ipsum asperiores laboriosam ipsa enim
        dolor perferendis.
      </p>

      <p class="text-slate-400 text-sm leading-relaxed relative z-10">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat fugiat soluta consectetur reprehenderit
        facere, quis error quidem harum quam laborum inventore quasi minima ipsum asperiores laboriosam ipsa enim
        dolor perferendis.
      </p>

      <!-- Stats Grid -->
      <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-800 relative z-10">
        <div
          class="bg-slate-950/60 border border-slate-800/80 p-5 rounded-2xl text-center group hover:border-indigo-500/50 transition-colors">
          <i class="fa fa-project-diagram text-indigo-400 text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
          <strong class="block text-2xl font-bold text-white">{{ $projects->total() }}</strong>
          <span class="text-xs text-slate-400 font-medium">Total Projects</span>
        </div>

        <div
          class="bg-slate-950/60 border border-slate-800/80 p-5 rounded-2xl text-center group hover:border-cyan-500/50 transition-colors">
          <i class="fas fa-rocket text-cyan-400 text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
          @if ($experience && $experience->count > 0)
            <strong class="block text-2xl font-bold text-white">
              {{ $experience->count }}+
            </strong>
          @else
            <strong class="block text-2xl font-bold text-white">5+</strong>
          @endif
          <span class="text-xs text-slate-400 font-medium">Years Experience</span>
        </div>
      </div>
    </div>

    <!-- Skills Column (Clean White/Sleek Card with Gradients) -->
    <div id="skills" class="lg:col-span-7 bg-white p-8 rounded-3xl shadow-xl border border-slate-100 space-y-6">
      <h4 class="text-2xl font-bold text-slate-900 border-l-4 border-indigo-600 pl-3 tracking-tight">MY SKILLS</h4>

      <div class="space-y-5 pt-2">
        @foreach ($skills as $skill)
          <div class="space-y-2 group">
            <div class="flex justify-between text-sm font-semibold">
              <span class="text-slate-700 group-hover:text-indigo-600 transition-colors">{{ $skill->name }}</span>
              <span class="text-indigo-600 font-mono">{{ $skill->percent }}%</span>
            </div>
            <!-- Progress Bar with Gradient -->
            <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden p-0.5 border border-slate-200/60">
              <div
                class="bg-gradient-to-r from-indigo-500 to-cyan-500 h-full rounded-full transition-all duration-700 shadow-sm"
                style="width: {{ $skill->percent }}%;">
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

  </section>

  <!-- MY PROJECTS SECTION -->
  <section class="bg-slate-900 border border-slate-800 rounded-2xl p-6 md:p-10 space-y-12 shadow-xl">

    <!-- Section Header -->
    <div class="text-center space-y-2">
      <h2 class="text-3xl font-extrabold text-white tracking-tight">MY PROJECTS</h2>
      <p class="text-slate-400 text-sm max-w-md mx-auto">Some of the works, web applications, and platforms I've explored
        and built.</p>
    </div>

    <!-- Projects Grid (3 Columns) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      @foreach ($projects as $project)
        <a href="{{ $project->link }}" target="_blank"
          class="bg-slate-950/70 text-white rounded-3xl p-6 shadow-md border border-slate-800 hover:shadow-xl hover:border-indigo-500/50 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group block cursor-pointer relative overflow-hidden">

          <!-- Background Glow Accent -->
          <div
            class="absolute -right-10 -top-10 w-32 h-32 bg-indigo-500/15 rounded-full blur-2xl group-hover:bg-indigo-500/30 transition-all">
          </div>

          <div class="space-y-4 relative z-10">
            <div class="flex justify-between items-center">
              <span class="bg-white/10 text-indigo-300 text-xs font-semibold px-3 py-1 rounded-full backdrop-blur-md">
                {{ $project->tag }}
              </span>
              <span class="text-slate-400 group-hover:text-white transition">
                <svg class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" fill="none"
                  stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </span>
            </div>

            <div class="space-y-2 pt-4">
              <h3 class="text-xl font-bold tracking-tight text-white group-hover:text-indigo-300 transition-colors">
                {{ $project->title }}
              </h3>
              <p class="text-slate-400 text-xs leading-relaxed line-clamp-3">{{ $project->description }}</p>
            </div>
          </div>

          <div
            class="pt-8 mt-6 border-t border-slate-800/80 flex items-center justify-between text-xs text-slate-400 relative z-10">
            <span>Explore Repository</span>
            <span class="font-semibold text-indigo-400">Live Demo</span>
          </div>
        </a>
      @endforeach
    </div>

    <!-- Modern Minimalist Pagination (Option B) -->
    <div class="pt-6 border-t border-slate-800 flex items-center justify-between">
      <span class="text-xs text-slate-400">
        Showing page <span class="text-white font-medium">{{ $projects->currentPage() }}</span> of
        {{ $projects->lastPage() }}
      </span>
      <div class="flex items-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($projects->onFirstPage())
          <span class="p-2.5 rounded-xl bg-slate-950 text-slate-600 border border-slate-800 cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </span>
        @else
          <a href="{{ $projects->previousPageUrl() }}"
            class="p-2.5 rounded-xl bg-slate-950 text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </a>
        @endif

        {{-- Next Page Link --}}
        @if ($projects->hasMorePages())
          <a href="{{ $projects->nextPageUrl() }}"
            class="p-2.5 rounded-xl bg-indigo-600 text-white hover:bg-indigo-500 transition shadow-lg shadow-indigo-500/25">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </a>
        @else
          <span class="p-2.5 rounded-xl bg-slate-950 text-slate-600 border border-slate-800 cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </span>
        @endif
      </div>
    </div>

  </section>

  <!-- LATEST POSTS FROM BLOGS -->
  <section class="space-y-8">
    <div class="text-center max-w-2xl mx-auto">
      <h2 class="text-3xl font-bold text-slate-900">LATEST POSTS FROM BLOGS</h2>
      <p class="text-slate-500 text-sm mt-2">
        Hey Guys! I warmly welcome you to read some of my blog posts. Here are very interesting and exciting posts you
        can read that i am supporting for you guys!
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Blog Post Card -->
      @foreach ($latestposts as $latestpost)
        <a href="{{ url('posts/' . $latestpost->id . '/details') }}"
          class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">

          <!-- Image Container with Zoom Effect -->
          <div class="relative overflow-hidden h-52">
            <img src="{{ asset('storage/' . $latestpost->image) }}"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Post Image">
            <!-- Optional subtle gradient overlay on image -->
            <div
              class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
            </div>
          </div>

          <!-- Card Content Body -->
          <div class="p-6 flex flex-col flex-grow justify-between space-y-3">
            <div class="space-y-2">
              <!-- Date & Author Tag -->
              <div class="flex items-center gap-2 text-xs font-semibold text-indigo-800">
                <i class="far fa-calendar-alt text-[10px]"></i>
                <span>{{ $latestpost->created_at->format('j F, Y') }}</span>
              </div>

              <!-- Title -->
              <h4
                class="font-bold text-slate-900 text-base leading-snug group-hover:text-indigo-600 transition-colors line-clamp-2">
                {{ $latestpost->title }}
              </h4>

              <!-- Excerpt / Content -->
              <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed">
                {{ Str::limit(strip_tags($latestpost->content), 120) }}
              </p>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </section>


@endsection