@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 md:p-10">

            <div class="mb-8 border-b border-slate-100 pb-4">
                <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Create an Account</h3>
                <p class="text-xs text-slate-500 mt-1">Please fill in your details to register.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Profile Image Input -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Profile Image</label>
                    <div class="flex items-center space-x-4">
                        <input type="file" name="image"
                            class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition cursor-pointer bg-slate-50 border border-slate-200 rounded-xl">
                    </div>
                    @error('image')
                        <span class="text-xs text-rose-500 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Name -->
                <div class="space-y-1.5">
                    <label for="name" class="text-sm font-semibold text-slate-700">{{ __('Name') }}</label>
                    <input id="name" type="text"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-indigo-600 focus:bg-white text-slate-800 transition-all @error('name') border-rose-500 @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="Enter your full name">

                    @error('name')
                        <span class="text-xs text-rose-500 block mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="space-y-1.5">
                    <label for="email" class="text-sm font-semibold text-slate-700">{{ __('Email Address') }}</label>
                    <input id="email" type="email"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-indigo-600 focus:bg-white text-slate-800 transition-all @error('email') border-rose-500 @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="name@example.com">

                    @error('email')
                        <span class="text-xs text-rose-500 block mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label for="password" class="text-sm font-semibold text-slate-700">{{ __('Password') }}</label>
                    <input id="password" type="password"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-indigo-600 focus:bg-white text-slate-800 transition-all @error('password') border-rose-500 @enderror"
                        name="password" required autocomplete="new-password" placeholder="••••••••">

                    @error('password')
                        <span class="text-xs text-rose-500 block mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1.5">
                    <label for="password-confirm"
                        class="text-sm font-semibold text-slate-700">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-indigo-600 focus:bg-white text-slate-800 transition-all"
                        name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition shadow-lg shadow-indigo-600/25 text-sm">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection