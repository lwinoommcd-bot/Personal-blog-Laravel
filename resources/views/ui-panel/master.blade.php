<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="icon"
    href="https://img.magnific.com/premium-vector/code-tag-icon-programming-web-development_106214-1988.jpg?semt=ais_hybrid&w=740&q=80"
    type="image/png">
  <!-- TAILWIND CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- ALPINE.JS CDN  -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-500 selection:text-white">

  <!-- HEADER / HERO SECTION -->
  <header class="relative min-h-[55vh] bg-cover bg-[center_top_15%] flex items-center text-white pb-12 overflow-hidden"
    style="background-image: linear-gradient(to right, rgba(15, 23, 42, 0.25), rgba(15, 23, 42, 0.75)), url('{{ asset('images/dev3.jpg') }}');">

    <!-- Navbar Inside Header with Alpine.js Mobile Burger Menu -->
    <nav class="absolute top-0 left-0 pt-6 w-full z-50 px-6 py-4 max-w-7xl mx-auto right-0"
      x-data="{ mobileMenuOpen: false }">
      <div class="flex justify-between items-center">

        <!-- Logo -->
        <a href="{{ url('/') }}"
          class="text-2xl font-black tracking-tight bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">
          Sid.Dev
        </a>

        <!-- Desktop Menu (Hidden on Mobile) -->
        <div class="hidden md:flex gap-8 font-medium text-sm items-center text-slate-300">
          <a href="{{ url('/') }}"
            class="text-md hover:text-blue-400 text-white font-semibold transition-colors">HOME</a>
          <a href="{{ url('posts') }}" class="text-md hover:text-blue-400 transition-colors">BLOGS</a>

          @if (Auth::check())
            <div class="flex items-center gap-2">
              @if(Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile"
                  style="width: 25px; height: 25px; border-radius: 50%; object-fit: cover;">
              @else
                <div
                  style="width: 25px; height: 25px; border-radius: 50%; background-color: #4f46e5; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px;">
                  {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
              @endif
              <span class="text-white font-medium">{{ strtoupper(Auth::user()->name) }}</span>
            </div>

            <a href="{{ route('logout') }}" class="hover:text-blue-400 transition-colors"
              onclick="event.preventDefault(); if(confirm('Are sure want to logout'))document.getElementById('logout-form').submit();">LOGOUT</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
              @csrf
            </form>
          @else
            <a href="{{ url('/login') }}" class="hover:text-blue-400 transition-colors">LOGIN</a>
            <a href="{{ url('/register') }}" class="hover:text-blue-400 transition-colors">REGISTER</a>
          @endif
        </div>

        <!-- Mobile Burger Button (Visible only on Mobile) -->
        <button @click="mobileMenuOpen = !mobileMenuOpen"
          class="md:hidden text-slate-300 hover:text-white focus:outline-none p-2">
          <!-- Hamburger Icon -->
          <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <!-- Close (X) Icon -->
          <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Mobile Dropdown Menu -->
      <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden mt-4 bg-slate-900/95 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 shadow-2xl flex flex-col space-y-4 text-slate-300"
        style="display: none;">

        <a href="{{ url('/') }}"
          class="hover:text-blue-400 text-white font-semibold transition-colors py-2 border-b border-slate-800">HOME</a>
        <a href="{{ url('posts') }}"
          class="hover:text-blue-400 transition-colors py-2 border-b border-slate-800">BLOGS</a>

        @if (Auth::check())
          <div class="flex items-center gap-2 py-2 border-b border-slate-800">
            @if(Auth::user()->image)
              <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile"
                style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
            @else
              <div
                style="width: 32px; height: 32px; border-radius: 50%; background-color: #4f46e5; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
              </div>
            @endif
            <span class="text-white font-medium">{{ Auth::user()->name }}</span>
          </div>

          <a href="{{ route('logout') }}" class="hover:text-blue-400 transition-colors py-2 border-b border-slate-800"
            onclick="event.preventDefault(); if(confirm('Are sure want to logout'))document.getElementById('logout-form').submit();">LOGOUT</a>
        @else
          <a href="{{ url('/login') }}"
            class="hover:text-blue-400 transition-colors py-2 border-b border-slate-800">LOGIN</a>
          <a href="{{ url('/register') }}" class="hover:text-blue-400 transition-colors py-2">REGISTER</a>
        @endif
      </div>
    </nav>

    <!-- Hero Content -->
    <div class="max-w-7xl mx-auto w-full px-6 pt-24 pb-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center z-10">

      <!-- Left: Spacer -->
      <div class="hidden lg:block"></div>

      <!-- Right: Text Content -->
      <div class="text-left lg:text-right space-y-5">
        <div class="flex flex-wrap gap-2 justify-start lg:justify-end">
          <span
            class="px-3 py-1 rounded-md bg-indigo-500/20 text-indigo-300 border border-indigo-400/30 text-xs font-mono">Laravel</span>
          <span
            class="px-3 py-1 rounded-md bg-cyan-500/20 text-cyan-300 border border-cyan-400/30 text-xs font-mono">TailwindCSS</span>
          <span
            class="px-3 py-1 rounded-md bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-xs font-mono">Full-Stack</span>
        </div>
        <div>
          <span
            class="px-4 py-1.5 rounded-full bg-blue-500/30 text-blue-200 border border-blue-400/40 text-xs sm:text-sm font-semibold tracking-widest uppercase inline-block shadow-md">
            Welcome to my digital space
          </span>
        </div>
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black tracking-tight drop-shadow-xl"
          style="background: linear-gradient(to right, #818cf8, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
          Sid W
        </h1>
        <p class="text-xl sm:text-2xl lg:text-3xl font-semibold text-slate-100 drop-shadow-md">THE HAPPY CODER</p>

        <div class="pt-3">
          <a href="{{ url('posts') }}"
            class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white font-mono text-sm px-6 py-3 rounded-xl border border-slate-700 shadow-xl transition-all">
            <span class="text-indigo-400">&gt;</span> Explore My Blogs
          </a>
        </div>
      </div>

    </div>
  </header>

  <!-- MAIN CONTAINER -->
  <main class="max-w-7xl mx-auto px-6 py-16 space-y-24">
    @yield('content')
  </main>

  <!-- FOOTER SECTION -->
  <footer class="bg-slate-900 text-slate-300 py-16 mt-20">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12">

      <div class="space-y-4">
        <h5 class="text-white font-bold tracking-wider text-sm">ABOUT THIS WEBSITE</h5>
        <p class="text-slate-400 text-sm leading-relaxed">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae sequi, architecto laborum excepturi molestiae
          dolore? Beatae distinctio.
        </p>
      </div>

      <div class="space-y-4">
        <h5 class="text-white font-bold tracking-wider text-sm">CONTACT INFO</h5>
        <p class="text-sm flex items-center gap-3"><i class="fas fa-mobile-alt text-blue-400"></i> 09403438913</p>
        <p class="text-sm flex items-center gap-3"><i class="far fa-envelope text-blue-400"></i>
          yms.yemyintsoe@gmail.com</p>
      </div>

      <div class="space-y-4">
        <h5 class="text-white font-bold tracking-wider text-sm">FOLLOW ME ON</h5>
        <div class="flex gap-4 text-xl">
          <a href="https://www.facebook.com/ye.m.soe.96387/" target="_blank"
            class="hover:text-blue-400 transition-colors"><i class="fab fa-facebook-square"></i></a>
          <a href="https://www.instagram.com/yemyintsoe_salai/" target="_blank"
            class="hover:text-blue-400 transition-colors"><i class="fab fa-instagram-square"></i></a>
          <a href="https://www.linkedin.com/in/ye-myint-soe-28a2aa1a0/" target="_blank"
            class="hover:text-blue-400 transition-colors"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="hover:text-blue-400 transition-colors"><i class="fab fa-twitter-square"></i></a>
        </div>
      </div>

    </div>
  </footer>

</body>

</html>