@extends('admin-panel.master')
@section('title', 'Skills List')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
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
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header Section -->
            <div class="p-6 flex justify-between items-center border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Skills List</h3>
                <a href="{{ url('admin/skills/create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition shadow-sm">
                    + Add New Skill
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                            <th class="py-3.5 px-6">ID</th>
                            <th class="py-3.5 px-6">Skill Name</th>
                            <th class="py-3.5 px-6">Percentage</th>
                            <th class="py-3.5 px-6">Created At</th>
                            <th class="py-3.5 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        @foreach ($skills as $skill)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 font-medium text-gray-900">{{ $skill->id }}</td>
                                <td class="py-4 px-6 font-semibold text-gray-800">{{ $skill->name }}</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <span class="text-sm font-medium text-gray-700">{{ $skill->percent }}</span>
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $skill->percent }}%">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-500 text-xs">{{ $skill->created_at}}</td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <a href="{{ url('admin/skills/'.$skill->id .'/edit') }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-lg text-xs font-medium transition">
                                        Edit
                                    </a>
                                    <form action="{{ url('admin/skills/'.$skill->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-xs font-medium transition"
                                            onclick="return confirm('Are you sure to Delete?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-3">
                    {{ $skills->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection