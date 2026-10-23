<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">{{ __('Student Dashboard') }}</h2>
                <p class="text-sm text-gray-500 mt-0.5">{{ now()->format('l, d M Y') }}</p>
            </div>
            <span class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 text-sm font-medium capitalize">
                <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                {{ Auth::user()->role }}
            </span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 to-blue-800 p-8 sm:p-10 text-white shadow-lg">
                <div class="absolute -top-16 -right-16 h-56 w-56 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-20 right-28 h-40 w-40 rounded-full bg-white/5"></div>
                <div class="relative">
                    <h3 class="text-3xl sm:text-4xl font-bold">Welcome back, {{ Auth::user()->name }} 👋</h3>
                    <p class="mt-2 text-blue-100 max-w-xl">Check your subjects, grades and schedule.</p>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $stats = [
                        ['label' => 'My Subjects', 'value' => 0, 'icon' => 'M12 6.25v13m0-13C10.83 5.48 9.25 5 7.5 5S4.17 5.48 3 6.25v13C4.17 18.48 5.75 18 7.5 18s3.33.48 4.5 1.25m0-13C13.17 5.48 14.75 5 16.5 5c1.75 0 3.33.48 4.5 1.25v13C19.83 18.48 18.25 18 16.5 18c-1.75 0-3.33.48-4.5 1.25'],
                        ['label' => 'Average Grade', 'value' => '--', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                        ['label' => 'Attendance', 'value' => '--', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Assignments', 'value' => 0, 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                                <p class="mt-1 text-3xl font-bold text-gray-800">{{ $stat['value'] }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
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
                    @foreach ([['My Subjects', '📚', '#'], ['My Grades', '📝', '#'], ['Timetable', '🗓️', '#']] as [$title, $emoji, $link])
                        <a href="{{ $link }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50/60 transition">
                            <span class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50 text-xl">{{ $emoji }}</span>
                            <span class="font-medium text-gray-700">{{ $title }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Latest Grades -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800">Latest Grades</h3>
                <div class="mt-4 text-center py-8 text-gray-400">
                    <div class="text-4xl">📝</div>
                    <p class="mt-2 text-sm">No grades have been published yet.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
