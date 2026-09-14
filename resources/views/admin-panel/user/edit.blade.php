@extends('admin-panel.master')
@section('title','Edit Profile')
@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit User</h1>
                <p class="text-sm text-gray-500 mt-1">Update user profile information and role status.</p>
            </div>
            <a href="{{ url('admin/users') }}"
                class="text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                &larr; Back
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
            <form action="{{ url('admin/users/' . $user->id . '/update') }}" method="POST">
                @csrf
                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                        Address</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <!-- Status Select (Admin / Member) -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">User Status
                        (Role)</label>
                    <select id="status" name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                        <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->status == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ url('admin/users') }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow transition">
                        Update User
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection