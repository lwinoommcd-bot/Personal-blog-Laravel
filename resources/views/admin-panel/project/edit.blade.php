@extends('admin-panel.master')
@section('title', 'skill create')
@section('content')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border border-gray-200">

                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Edit Project</h2>
                    <p class="text-sm text-gray-500 mt-1">Update the project details below.</p>
                </div>

                <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tag</label>
                        <input type="text" value="{{ $project->tag ?? old('tag') }}" name="tag"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                    @error('tag')
                        <span class="text-red-400"><small>{{ $message }}</small></span>
                    @enderror

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                        <input type="text" value="{{ $project->title ?? old('title') }}" name="title"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                    @error('title')
                        <span class="text-red-400"><small>{{ $message }}</small></span>
                    @enderror

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea rows="4" name="description"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">{{ $project->description ?? old('description') }}</textarea>
                    </div>
                    @error('description')
                        <span class="text-red-400"><small>{{ $message }}</small></span>
                    @enderror

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Link</label>
                        <input type="url" value="{{ $project->link ?? old('link') }}" name="link"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                    @error('link')
                        <span class="text-red-400"><small>{{ $message }}</small></span>
                    @enderror

                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ url('admin/projects') }}"
                            class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm font-medium transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium shadow-sm transition">
                            Update Project
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection