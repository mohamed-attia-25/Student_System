<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">{{ $subject->name }}</h2>
                <p class="text-sm text-gray-500 mt-0.5">Subject details</p>
            </div>
            <a href="{{ route('subjects.index') }}"
               class="px-3 py-1.5 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Subject info -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800">Subject Information</h3>

                <dl class="mt-5 space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <dt class="text-sm text-gray-500">Subject ID</dt>
                            <dd class="mt-1 font-semibold text-gray-800">#{{ $subject->id }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-gray-500">Code</dt>
                            <dd class="mt-1">
                                <span class="px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium uppercase">
                                    {{ $subject->code }}
                                </span>
                            </dd>
                        </div>
                    </div>

                    <div>
                        <dt class="text-sm text-gray-500">Name</dt>
                        <dd class="mt-1 font-semibold text-gray-800">{{ $subject->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm text-gray-500">Description</dt>
                        <dd class="mt-1 text-gray-700 whitespace-pre-line">{{ $subject->description ?: '—' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-5 border-t border-gray-100">
                        <div>
                            <dt class="text-sm text-gray-500">Created At</dt>
                            <dd class="mt-1 text-gray-800">
                                {{ $subject->created_at?->format('d M Y, h:i A') }}
                                <span class="block text-xs text-gray-400">{{ $subject->created_at?->diffForHumans() }}</span>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm text-gray-500">Last Updated</dt>
                            <dd class="mt-1 text-gray-800">
                                @if ($subject->updated_by_name)
                                    {{ $subject->updated_at?->format('d M Y, h:i A') }}
                                    <span class="block text-xs text-gray-400">{{ $subject->updated_at?->diffForHumans() }}</span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </dd>
                        </div>
                    </div>
                </dl>
            </div>

            <!-- Created by -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800">Created By</h3>

                @if ($subject->created_by_name)
                    <dl class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <dt class="text-sm text-gray-500">User ID</dt>
                            <dd class="mt-1 font-semibold text-gray-800">#{{ $subject->created_by_id }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-gray-500">Role</dt>
                            <dd class="mt-1">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium capitalize
                                             {{ $subject->created_by_role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $subject->created_by_role }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm text-gray-500">Name</dt>
                            <dd class="mt-1 text-gray-800">{{ $subject->created_by_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-gray-500">Email</dt>
                            <dd class="mt-1 text-gray-800 break-all">{{ $subject->created_by_email }}</dd>
                        </div>
                    </dl>
                @else
                    <p class="mt-4 text-sm text-gray-400">No creator information was saved for this subject.</p>
                @endif
            </div>

            <!-- Last updated by -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Last Updated By</h3>
                    @if ($subject->updated_by_name)
                        <span class="text-xs text-gray-400">{{ $subject->updated_at?->format('d M Y, h:i A') }}</span>
                    @endif
                </div>

                @if ($subject->updated_by_name)
                    <dl class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <dt class="text-sm text-gray-500">User ID</dt>
                            <dd class="mt-1 font-semibold text-gray-800">#{{ $subject->updated_by_id }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-gray-500">Role</dt>
                            <dd class="mt-1">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium capitalize
                                             {{ $subject->updated_by_role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $subject->updated_by_role }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm text-gray-500">Name</dt>
                            <dd class="mt-1 text-gray-800">{{ $subject->updated_by_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-gray-500">Email</dt>
                            <dd class="mt-1 text-gray-800 break-all">{{ $subject->updated_by_email }}</dd>
                        </div>
                    </dl>
                @else
                    <p class="mt-4 text-sm text-gray-400">This subject has not been updated yet.</p>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('subjects.edit', $subject) }}"
                   class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition">
                    Edit
                </a>
                <a href="{{ route('subjects.index') }}"
                   class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100 transition">
                    Back to list
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
