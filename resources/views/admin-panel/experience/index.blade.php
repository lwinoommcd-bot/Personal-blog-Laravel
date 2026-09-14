@extends('admin-panel.master')
@section('title', 'Experience')
@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-6">
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
            <h2 class="text-xl font-bold text-slate-900">Manage Experience Years</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        <th class="py-3 px-4">Current experience</th>
                        <th class="py-3 px-4">Count (Experience)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="py-4 px-4 font-medium text-slate-900">{{ $experience->count}}</td>

                        <!-- Count Input Box & Update Form -->
                        <td class="py-4 px-4">
                            <div x-data="{ count: '{{ $experience->count }}', initial: '{{ $experience->count }}' }">
                                <form action="{{ url('admin/experiences/' . $experience->id . '/update') }}" method="POST"
                                    class="flex items-center space-x-3"
                                    onsubmit="return confirm('Are you sure want to update experience to ' + this.querySelector('input[name=count]').value + ' years?');">
                                    @csrf

                                    <input type="number" name="count" x-model="count" required
                                        class="w-24 bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-sm font-bold focus:outline-none focus:border-indigo-600 transition-colors"
                                        :class="count !== initial ? 'text-rose-600 bg-rose-50/30' : 'text-indigo-600'">

                                    <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-xs px-4 py-2 rounded-xl transition shadow-sm">
                                        Update
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            <!-- Pagination links will appear here -->
        </div>
    </div>
@endsection