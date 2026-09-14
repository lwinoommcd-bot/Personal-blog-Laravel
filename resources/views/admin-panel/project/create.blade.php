@extends('admin-panel.master')
@section('title', 'skill create')
@section('content')
  <div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border border-gray-200">
            
            <div class="mb-6 pb-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Create New Project</h2>
                <p class="text-sm text-gray-500 mt-1">Fill in the details below to add a new project.</p>
            </div>

            <form action="{{ url('admin/projects') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tag</label>
                    <input type="text" placeholder="e.g. Laravel" name="tag" value="{{ old('tag') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                </div>
                @error('tag')
                <span class="text-red-400"><small>{{ $message }}</small></span>
                @enderror

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                    <input type="text" placeholder="e.g. E-Commerce Web App"  name="title" value="{{ old('title') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                </div>
                @error('title')
                <span class="text-red-400"><small>{{ $message }}</small></span>
                @enderror

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea rows="4" placeholder="Enter project description..."  name="description" 
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">{{ old('description') }}</textarea>
                </div>
                @error('description')
                <span class="text-red-400"><small>{{ $message }}</small></span>
                @enderror

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Link</label>
                    <input type="url" placeholder="https://www.google.com" name="link" {{ old('link') }}
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                </div>
                @error('link')
                <span class="text-red-400"><small>{{ $message }}</small></span>
                @enderror

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ url('admin/projects ') }}" class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm font-medium transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium shadow-sm transition">
                        Create Project
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection