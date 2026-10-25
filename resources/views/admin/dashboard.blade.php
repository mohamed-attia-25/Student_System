<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">{{ __('Admin Dashboard') }}</h2>
                <p class="text-sm text-gray-500 mt-0.5">{{ now()->format('l, d M Y') }}</p>
            </div>
            <span class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 text-sm font-medium capitalize">
                <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                {{ Auth::user()->role }}
            </span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 to-indigo-800 p-8 sm:p-10 text-white shadow-lg">
                <div class="absolute -top-16 -right-16 h-56 w-56 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-20 right-28 h-40 w-40 rounded-full bg-white/5"></div>
                <div class="relative">
                    <h3 class="text-3xl sm:text-4xl font-bold">Welcome back, {{ Auth::user()->name }} 👋</h3>
                    <p class="mt-2 text-indigo-100 max-w-xl">Manage users, subjects and the whole system from here.</p>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $stats = [
                        ['label' => 'Total Users', 'value' => \App\Models\User::count(), 'icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4.13a4 4 0 11-8 0 4 4 0 018 0zm6 0a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['label' => 'Students', 'value' => \App\Models\User::where('role', 'student')->count(), 'icon' => 'M12 14l9-5-9-5-9 5 9 5z'],
                        ['label' => 'Teachers', 'value' => \App\Models\User::where('role', 'teacher')->count(), 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['label' => 'Active Users', 'value' => \App\Models\User::where('is_active', true)->count(), 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                                <p class="mt-1 text-3xl font-bold text-gray-800">{{ $stat['value'] }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
                <p class="text-sm text-gray-500">Jump straight to common tasks.</p>
                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ([
                        ['Add Admin',       '🛡️', route('admins.create')],
                        ['Add Teacher',     '🎓', route('teachers.create')],
                        ['Add Parent',      '👪', route('parents.create')],
                        ['Add Subject',     '📚', route('subjects.create')],
                        ['Manage Subjects', '🗂️', route('subjects.index')],
                        ['Reports',         '📊', '#'],
                    ] as [$title, $emoji, $link])
                        <a href="{{ $link }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 hover:border-indigo-300 hover:bg-indigo-50/60 transition">
                            <span class="flex items-center justify-center h-10 w-10 rounded-lg bg-indigo-50 text-xl">{{ $emoji }}</span>
                            <span class="font-medium text-gray-700">{{ $title }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800">Recent Users</h3>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-2 pr-4 font-medium">Name</th>
                                <th class="py-2 pr-4 font-medium">Email</th>
                                <th class="py-2 pr-4 font-medium">Role</th>
                                <th class="py-2 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach (\App\Models\User::latest()->take(5)->get() as $user)
                                <tr>
                                    <td class="py-3 pr-4 text-gray-800">{{ $user->name }}</td>
                                    <td class="py-3 pr-4 text-gray-500">{{ $user->email }}</td>
                                    <td class="py-3 pr-4 capitalize">{{ $user->role }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-0.5 rounded-full text-xs {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
