@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex flex-col items-center justify-center py-16 px-4">
        
        <!-- Top Subtitle -->
        <div class="text-[11px] tracking-[2px] text-[#777] mb-3 uppercase">Letters From Somewhere</div>

        <!-- Login Card (Slightly larger and more spacious) -->
        <div class=" w-full max-w-lg p-10 md:p-12 shadow-xl rounded-3xl border border-[#f4f0eb]">
            <h2 class="text-3xl font-normal text-gray-900 mb-8 text-center italic font-serif">Personal-Blog</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs uppercase tracking-wider text-gray-600 mb-2 font-medium">Email Address</label>
                    <input id="email" type="email" class="w-full px-4 py-3.5 border @error('email') border-rose-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm bg-white"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">

                    @error('email')
                        <span class="text-rose-500 text-xs mt-1 block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs uppercase tracking-wider text-gray-600 mb-2 font-medium">Password</label>
                    <input id="password" type="password"
                        class="w-full px-4 py-3.5 border @error('password') border-rose-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm bg-white" name="password"
                        required autocomplete="current-password" placeholder="Enter your password">

                    @error('password')
                        <span class="text-rose-500 text-xs mt-1 block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Buttons Section (Login & Register) -->
                <div class="flex items-center justify-between pt-6 border-t border-[#dcd6cb]">
                    <!-- Login Button -->
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl text-sm font-medium shadow-md transition">
                        {{ __('Login') }}
                    </button>

                    <!-- Register Link -->
                    <a href="{{ route('register') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition underline underline-offset-4">
                        Create Account
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection