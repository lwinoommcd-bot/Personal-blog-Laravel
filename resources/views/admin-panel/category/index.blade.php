@extends('admin-panel.master')
@section('title', 'Project create')
@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-6">
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
        <!-- Header Section -->
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-slate-900">Manage Categories</h2>
            <a href="{{ url('admin/categories/create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl transition shadow-sm inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Category
            </a>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Category Name</th>
                        <th class="py-3 px-4">Created At</th>
                        <th class="py-3 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    <!-- Static Row Example (HTML Only) -->
                    @foreach ($categories as $category)
                        <!-- Row -->
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-4 px-4 font-medium text-slate-900">{{ $category->id }}</td>
                            <td class="py-4 px-4 font-semibold text-slate-800">{{ $category->name }}</td>
                            <td class="py-4 px-4 text-slate-500 text-xs">{{ $category->created_at }}</td>
                            <td class="py-4 px-4 text-right space-x-2">
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="text-indigo-600 hover:text-indigo-800 font-medium text-xs bg-indigo-50 px-3 py-1.5 rounded-lg transition">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure want to delete?')"
                                        class="text-rose-600 hover:text-rose-800 font-medium text-xs bg-rose-50 px-3 py-1.5 rounded-lg transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>
        </div>
    </div>
@endsection