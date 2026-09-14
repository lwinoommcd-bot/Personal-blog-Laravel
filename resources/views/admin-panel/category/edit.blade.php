@extends('admin-panel.master')
@section('title', 'category edit')
@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 mt-10 p-6 sm:p-8 space-y-6">
        <div class="flex justify-between items-center border-b border-slate-100 pb-4">
            <h2 class="text-xl font-bold text-slate-900">Edit Category</h2>
            <a href="{{url('admin/categories')}}"
                class="text-sm font-medium text-slate-500 hover:text-slate-800 transition">Back</a>
        </div>

        <form action="{{ route('categories.update',$category->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Category
                    Name</label>
                <input type="text" name="name" value="{{$category->name ?? old('name')}}" 
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-600 transition">
            </div>
            @error('name')
                <span class="text-red-400"><small>{{ $message }}</small></span>
            @enderror

            <div class="flex justify-end space-x-3 pt-2">
                <a href="{{ url('admin/categories') }}"
                    class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition shadow-sm">
                    Update Category
                </button>
            </div>
        </form>
    </div>
@endsection