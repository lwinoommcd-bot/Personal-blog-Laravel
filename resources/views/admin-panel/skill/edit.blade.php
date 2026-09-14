@extends('admin-panel.master')
@section('title', 'skill create')
@section('content')
    <div class="max-w-5xl mx-auto bg-white mt-20 p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Edit New Skill</h2>

        <form action="{{ url('admin/skills/' . $skill->id) }}" method="POST" class="space-y-5" novalidate>
            @csrf
            @method('PUT')
            <!-- Skill Name Input -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Skill Name</label>
                <input type="text" name="name" value="{{ $skill->name ?? old('name') }}" id="name"
                    placeholder="e.g. Laravel, Tailwind CSS" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm bg-gray-50">
            </div>
            @error('name')
                <span class="text-red-600"><small>{{ $message }}</small></span>
            @enderror

            <!-- Percent Input -->
            <div>
                <label for="percent" class="block text-sm font-medium text-gray-700 mb-1.5">Percentage (%)</label>
                <input type="number" value="{{ $skill->percent ?? old('percent')}}" name="percent" id="percent" min="0"
                    max="100" placeholder="e.g. 85" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm bg-gray-50">
            </div>
            @error('percent')
                <span class="text-red-600"><small>{{ $message }}</small></span>
            @enderror

            <!-- Submit & Cancel Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                <a href="{{ url('admin/skills') }}"
                    class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection