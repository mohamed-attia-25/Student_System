<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">{{ __('Teacher Dashboard') }}</h2>
                <p class="text-sm text-gray-500 mt-0.5">{{ now()->format('l, d M Y') }}</p>
            </div>
            <span class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-sm font-medium capitalize">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                {{ Auth::user()->role }}
            </span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-600 to-emerald-800 p-8 sm:p-10 text-white shadow-lg">
                <div class="absolute -top-16 -right-16 h-56 w-56 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-20 right-28 h-40 w-40 rounded-full bg-white/5"></div>
                <div class="relative">
                    <h3 class="text-3xl sm:text-4xl font-bold">Welcome back, {{ Auth::user()->name }} 👋</h3>
                    <p class="mt-2 text-emerald-100 max-w-xl">Your classes, attendance and grades in one place.</p>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $stats = [
                        ['label' => 'My Classes', 'value' => 0, 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1'],
                        ['label' => 'My Students', 'value' => 0, 'icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4.13a4 4 0 11-8 0 4 4 0 018 0zm6 0a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['label' => 'Subjects', 'value' => 0, 'icon' => 'M12 6.25v13m0-13C10.83 5.48 9.25 5 7.5 5S4.17 5.48 3 6.25v13C4.17 18.48 5.75 18 7.5 18s3.33.48 4.5 1.25m0-13C13.17 5.48 14.75 5 16.5 5c1.75 0 3.33.48 4.5 1.25v13C19.83 18.48 18.25 18 16.5 18c-1.75 0-3.33.48-4.5 1.25'],
                        ['label' => 'Pending Grades', 'value' => 0, 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                                <p class="mt-1 text-3xl font-bold text-gray-800">{{ $stat['value'] }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition">
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
                <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach ([['My Classes', '🏫', '#'], ['Take Attendance', '✅', '#'], ['Enter Grades', '📝', '#']] as [$title, $emoji, $link])
                        <a href="{{ $link }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 hover:border-emerald-300 hover:bg-emerald-50/60 transition">
                            <span class="flex items-center justify-center h-10 w-10 rounded-lg bg-emerald-50 text-xl">{{ $emoji }}</span>
                            <span class="font-medium text-gray-700">{{ $title }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Today's Schedule -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800">Today's Schedule</h3>
                <div class="mt-4 text-center py-8 text-gray-400">
                    <div class="text-4xl">🗓️</div>
                    <p class="mt-2 text-sm">No classes scheduled yet.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
