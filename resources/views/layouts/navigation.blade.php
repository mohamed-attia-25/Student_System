@php
    $isAdmin = Auth::user()->role === 'admin';

    $manageLinks = [
        ['Students', 'students.index', 'students.*', '🎓'],
        ['Teachers', 'teachers.index', 'teachers.*', '👨‍🏫'],
        ['Parents',  'parents.index',  'parents.*',  '👪'],
        ['Admins',   'admins.index',   'admins.*',   '🛡️'],
        ['Subjects', 'subjects.index', 'subjects.*', '📚'],
    ];

    $manageActive = collect($manageLinks)->contains(fn ($l) => request()->routeIs($l[2]));
@endphp

<nav x-data="{ open: false }"
     class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200/70">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Left: Logo + Links -->
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/student-svgrepo-com.svg') }}" alt="logo"
                        class="h-9 w-9 transition-transform duration-200 group-hover:scale-110">
                    <span class="hidden md:block text-lg font-bold tracking-tight text-gray-800">
                        Student<span class="text-indigo-600">System</span>
                    </span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center gap-1">
                    <a href="{{ route('dashboard') }}"
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors duration-150
                              {{ request()->routeIs('dashboard')
                                  ? 'bg-indigo-50 text-indigo-700'
                                  : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        {{ __('Dashboard') }}
                    </a>

                    {{-- Manage dropdown (admin only) --}}
                    @if ($isAdmin)
                        <div class="relative" x-data="{ manage: false }" @click.outside="manage = false" @keydown.escape.window="manage = false">
                            <button @click="manage = !manage"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-sm font-medium transition-colors duration-150
                                           {{ $manageActive
                                               ? 'bg-indigo-50 text-indigo-700'
                                               : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                                {{ __('Manage') }}
                                <svg class="h-4 w-4 transition-transform duration-200" :class="manage && 'rotate-180'"
                                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="manage" x-transition x-cloak
                                 class="absolute left-0 mt-2 w-56 rounded-xl bg-white shadow-lg ring-1 ring-black/5 p-1.5 z-50">
                                @foreach ($manageLinks as [$label, $route, $pattern, $emoji])
                                    <a href="{{ route($route) }}"
                                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
                                              {{ request()->routeIs($pattern)
                                                  ? 'bg-indigo-50 text-indigo-700 font-medium'
                                                  : 'text-gray-700 hover:bg-gray-100' }}">
                                        <span class="text-base">{{ $emoji }}</span>
                                        {{ $label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: User Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 pl-2 pr-3 py-1.5 rounded-full border border-gray-200 bg-white hover:bg-gray-50 hover:shadow-sm focus:outline-none transition duration-150">
                            <span class="flex items-center justify-center h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white text-sm font-semibold">
                                {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            <span class="inline-block mt-2 px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium capitalize">
                                {{ Auth::user()->role }}
                            </span>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    class="text-red-600 hover:bg-red-50"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" x-transition x-cloak class="sm:hidden border-t border-gray-100 bg-white">
        <div class="px-4 pt-3 pb-2 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded-lg text-base font-medium
                      {{ request()->routeIs('dashboard')
                          ? 'bg-indigo-50 text-indigo-700'
                          : 'text-gray-600 hover:bg-gray-100' }}">
                {{ __('Dashboard') }}
            </a>

            {{-- Manage section (admin only) --}}
            @if ($isAdmin)
                <div x-data="{ manageMobile: {{ $manageActive ? 'true' : 'false' }} }">
                    <button @click="manageMobile = !manageMobile"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-base font-medium
                                   {{ $manageActive ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span>{{ __('Manage') }}</span>
                        <svg class="h-4 w-4 transition-transform duration-200" :class="manageMobile && 'rotate-180'"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="manageMobile" x-transition x-cloak class="mt-1 ms-3 ps-3 border-s-2 border-indigo-100 space-y-1">
                        @foreach ($manageLinks as [$label, $route, $pattern, $emoji])
                            <a href="{{ route($route) }}"
                               class="flex items-center gap-3 px-3 py-2 rounded-lg text-base
                                      {{ request()->routeIs($pattern)
                                          ? 'bg-indigo-50 text-indigo-700 font-medium'
                                          : 'text-gray-600 hover:bg-gray-100' }}">
                                <span>{{ $emoji }}</span>
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="px-4 py-4 border-t border-gray-100">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-semibold">
                    {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                </span>
                <div class="min-w-0">
                    <div class="font-medium text-gray-800 truncate">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-4 space-y-1">
                <a href="{{ route('profile.edit') }}"
                   class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 hover:bg-gray-100">
                    {{ __('Profile') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-start px-3 py-2 rounded-lg text-base font-medium text-red-600 hover:bg-red-50">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
