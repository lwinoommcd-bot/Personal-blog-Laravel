@extends('admin-panel.master')
@section('title', 'Project create')
@section('content')
    <div class="space-y-4">
        <!-- Header with Create Button -->
        <!-- Created  Alert -->
        @if (session('successMsg'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
                class="mb-6 max-w-3xl flex items-center justify-between bg-green-50 border border-green-200 text-green-800 px-5 py-3.5 rounded-xl shadow-sm">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('successMsg') }}</span>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-900 focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endif

        
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Manage Projects</h2>
            <a href="{{ url('admin/projects/create') }}"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium shadow-sm transition inline-flex items-center gap-1.5">
                + Add New Project
            </a>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-500 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-4 px-6">ID</th>
                            <th class="py-4 px-6">Tag</th>
                            <th class="py-4 px-6">Title</th>
                            <th class="py-4 px-6">Description</th>
                            <th class="py-4 px-6">Link</th>
                            <th class="py-4 px-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                        <!-- Row 1 -->
                        @foreach ($projects as $project)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 text-gray-500">{{ $project->id }}</td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 text-xs font-semibold bg-indigo-100 text-indigo-700 rounded-full">
                                        {{ $project->tag }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-medium">{{ $project->title }}</td>
                                <td class="py-4 px-6 text-gray-600 truncate max-w-xs">{{ $project->description }}
                                </td>
                                <td class="py-4 px-6 text-xs space-y-1">
                                    <a href="https://www.google.com" target="_blank"
                                        class="text-blue-600 hover:underline">{{ $project->link }}</a>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <a href="{{ route('projects.edit', $project->id) }}"
                                        class="px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-medium rounded-md transition-colors inline-block">Edit</a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')"
                                            class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 text-xs font-medium rounded-md transition-colors">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-3">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection