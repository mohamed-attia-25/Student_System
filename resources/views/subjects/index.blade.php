<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">{{ __('Manage Subjects') }}</h2>
                <p class="text-sm text-gray-500 mt-0.5">
                    @if ($search !== '')
                        {{ $subjects->count() }} {{ Str::plural('result', $subjects->count()) }} for "{{ $search }}"
                    @else
                        {{ $subjects->count() }} {{ Str::plural('subject', $subjects->count()) }} in the system.
                    @endif
                </p>
            </div>
            <a href="{{ route('subjects.create') }}"
               class="px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition">
                + Add Subject
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4"
             x-data="{ confirmOpen: false, deleteUrl: '', deleteName: '' }"
             @keydown.escape.window="confirmOpen = false">

            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)"
                     x-show="show" x-transition
                     class="flex items-center justify-between gap-3 rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                    <span>✅ {{ session('success') }}</span>
                    <button type="button" @click="show = false" class="text-green-700/60 hover:text-green-800 text-lg leading-none">&times;</button>
                </div>
            @endif

            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">

                <!-- Search -->
                <form method="GET" action="{{ route('subjects.index') }}" class="mb-5 flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ $search }}"
                               placeholder="Search by name, code or description..."
                               class="block w-full rounded-xl border-gray-300 pl-9 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-5 py-2 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition">
                            Search
                        </button>
                        @if ($search !== '')
                            <a href="{{ route('subjects.index') }}"
                               class="px-4 py-2 rounded-xl border border-gray-300 text-gray-600 text-sm font-medium hover:bg-gray-50 transition">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-2 pr-4 font-medium">#</th>
                                <th class="py-2 pr-4 font-medium">Name</th>
                                <th class="py-2 pr-4 font-medium">Code</th>
                                <th class="py-2 pr-4 font-medium">Description</th>
                                <th class="py-2 pr-4 font-medium">Created At</th>
                                <th class="py-2 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($subjects as $subject)
                                <tr>
                                    <td class="py-3 pr-4 text-gray-400">{{ $loop->iteration }}</td>

                                    <td class="py-3 pr-4 font-medium text-gray-800">{{ $subject->name }}</td>

                                    <td class="py-3 pr-4">
                                        <span class="px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium uppercase">
                                            {{ $subject->code }}
                                        </span>
                                    </td>

                                    <td class="py-3 pr-4 text-gray-500">
                                        {{ Str::limit($subject->description, 60) ?: '—' }}
                                    </td>

                                    <td class="py-3 pr-4 text-gray-500 whitespace-nowrap" title="{{ $subject->created_at?->diffForHumans() }}">
                                        {{ $subject->created_at?->format('d M Y') }}
                                        <div class="text-xs text-gray-400">{{ $subject->created_at?->format('h:i A') }}</div>
                                    </td>

                                    <td class="py-3 text-right whitespace-nowrap">
                                        @if (Auth::user()->role === 'admin')
                                            <a href="{{ route('subjects.show', $subject) }}"
                                               class="px-3 py-1.5 rounded-lg border border-indigo-200 text-indigo-600 text-xs font-medium hover:bg-indigo-50 transition">
                                                Show
                                            </a>
                                        @endif
                                        <a href="{{ route('subjects.edit', $subject) }}"
                                           class="ml-1 px-3 py-1.5 rounded-lg border border-gray-300 text-gray-700 text-xs font-medium hover:bg-gray-50 transition">
                                            Edit
                                        </a>
                                        <button type="button"
                                                @click="deleteUrl = '{{ route('subjects.destroy', $subject) }}'; deleteName = @js($subject->name); confirmOpen = true"
                                                class="ml-1 px-3 py-1.5 rounded-lg border border-red-200 text-red-600 text-xs font-medium hover:bg-red-50 transition">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center">
                                        @if ($search !== '')
                                            <p class="text-4xl">🔍</p>
                                            <p class="mt-2 text-gray-500">No subjects match "{{ $search }}".</p>
                                            <a href="{{ route('subjects.index') }}" class="mt-3 inline-block text-indigo-600 font-medium hover:underline">
                                                Clear search
                                            </a>
                                        @else
                                            <p class="text-4xl">📚</p>
                                            <p class="mt-2 text-gray-500">No subjects yet.</p>
                                            <a href="{{ route('subjects.create') }}" class="mt-3 inline-block text-indigo-600 font-medium hover:underline">
                                                Add your first subject
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Delete confirmation modal -->
            <div x-show="confirmOpen" x-cloak
                 class="fixed inset-0 z-[60] flex items-center justify-center p-4">

                <div x-show="confirmOpen" x-transition.opacity
                     @click="confirmOpen = false"
                     class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>

                <div x-show="confirmOpen" x-transition
                     class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
                    <div class="flex items-start gap-4">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Delete subject?</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                You are about to delete
                                <span class="font-semibold text-gray-700" x-text="deleteName"></span>.
                                This action cannot be undone.
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" @click="confirmOpen = false"
                                class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100 transition">
                            Cancel
                        </button>
                        <form method="POST" :action="deleteUrl">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                                Yes, delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
