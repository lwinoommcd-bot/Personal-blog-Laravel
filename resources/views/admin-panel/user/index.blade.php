@extends('admin-panel.master')
@section('title', 'Profile')
@section('content')
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
            <p class="text-sm text-gray-500 mt-1">Manage all registered blog authors and readers here.</p>
        </div>
        <button
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow transition">
            + Add New User
        </button>
    </div>
    <!-- Updated Alert -->
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

    <!-- Stats Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Users</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">1,245</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Published Posts</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">84</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Categories</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">12</p>
        </div>
    </div>

    <!-- Table Wrapper -->
    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">

            <!-- Table Head -->
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">NAME</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">EMAIL
                    </th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">STATUS
                    </th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">
                        ACTION</th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $user)
                    <!-- User Row 1 -->
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $user->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2.5 py-1 inline-flex text-xs leading-4 font-semibold rounded-full {{ $user->status == 'admin' ? 'bg-green-200 text-green-800' : 'bg-indigo-100 text-indigo-800'}}">
                                {{ $user->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <!-- Edit Button -->
                            <a href="{{ url('admin/users/' . $user->id . '/edit') }}"
                                class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1.5 rounded-md transition inline-block">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ url('admin/users/' . $user->id . '/delete') }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Are you sure want to delete?');">
                                @csrf
                                <button type="submit"
                                    class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1.5 rounded-md transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection