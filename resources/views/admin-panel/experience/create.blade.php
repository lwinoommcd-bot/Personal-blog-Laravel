@extends('admin-panel.master')
@section('title', 'Experience create')
@section('content')
    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 p-8 space-y-6">
        <h2 class="text-xl font-bold text-slate-900">Create Experience Count</h2>

        <form action="{{ url('admin/experiences') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-2">Count Number</label>
                <input type="number" name="count" required
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-600 text-slate-800">
            </div>
            @error('count')
                <span class="text-red-400"><small>{{ $message }}</small></span>
            @enderror

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ url('admin/experiences') }}"
                    class="px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition">Cancel</a>
                <button type="submit"
                    class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition shadow-sm">Update</button>
            </div>
        </form>
    </div>
@endsection