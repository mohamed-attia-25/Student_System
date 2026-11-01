<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Student System') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#F5F7FA] text-[#101828] antialiased">

        {{-- Header --}}
        <header class="mx-auto flex max-w-6xl items-center justify-between px-6 py-5">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                <img src="{{ asset('images/student-svgrepo-com.svg') }}" alt="" class="h-9 w-9">
                <span class="text-base font-semibold tracking-tight">Student System</span>
            </a>

            @if (Route::has('login'))
                <nav class="flex items-center gap-2 text-sm font-medium">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="rounded-lg bg-[#101828] px-4 py-2 text-white transition hover:bg-black focus:outline-none focus:ring-2 focus:ring-[#2B3FD6] focus:ring-offset-2">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-lg px-4 py-2 text-[#101828] transition hover:bg-white focus:outline-none focus:ring-2 focus:ring-[#2B3FD6]">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="rounded-lg bg-[#101828] px-4 py-2 text-white transition hover:bg-black focus:outline-none focus:ring-2 focus:ring-[#2B3FD6] focus:ring-offset-2">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        {{-- Hero --}}
        <main>
            <section class="mx-auto grid max-w-6xl items-center gap-12 px-6 py-12 lg:grid-cols-2 lg:py-20">
                <div>
                    <h1 class="text-4xl font-semibold leading-[1.08] tracking-tight sm:text-5xl">
                        Every student, subject and grade in one place.
                    </h1>
                    <p class="mt-5 max-w-md text-base leading-relaxed text-[#475467]">
                        Student System keeps your school's records tidy. Add students, organise
                        subjects, and give each person access to exactly what their role needs.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="rounded-xl bg-[#2B3FD6] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#2233B0] focus:outline-none focus:ring-2 focus:ring-[#2B3FD6] focus:ring-offset-2">
                                Go to dashboard
                            </a>
                        @else
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}"
                                   class="rounded-xl bg-[#2B3FD6] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#2233B0] focus:outline-none focus:ring-2 focus:ring-[#2B3FD6] focus:ring-offset-2">
                                    Log in
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="rounded-xl border border-[#D0D5DD] bg-white px-6 py-3 text-sm font-semibold text-[#101828] transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#2B3FD6] focus:ring-offset-2">
                                    Create an account
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                {{-- Roll sheet: styled like an exercise-book page --}}
                <div class="overflow-hidden rounded-2xl border border-[#D9DFEA] bg-white shadow-sm">
                    <div class="flex items-center justify-between border-b border-[#D9DFEA] px-5 py-3">
                        <p class="text-sm font-semibold">Class 3B, Mathematics</p>
                        <p class="text-xs text-[#667085]">Term 1</p>
                    </div>

                    <ul class="relative divide-y divide-[#EAECF0]">
                        {{-- red margin line, like a notebook --}}
                        <span class="absolute inset-y-0 left-12 w-px bg-[#E5484D]/35" aria-hidden="true"></span>

                        <li class="flex items-center">
                            <span class="w-12 shrink-0 py-4 text-center text-xs text-[#98A2B3]">1</span>
                            <span class="flex-1 pl-4 text-sm font-medium">Omar Hassan</span>
                            <span class="mr-4 hidden h-1.5 w-24 overflow-hidden rounded-full bg-[#EAECF0] sm:block">
                                <span class="block h-full rounded-full bg-[#2B3FD6]" style="width: 92%"></span>
                            </span>
                            <span class="w-14 pr-5 text-right text-sm font-semibold tabular-nums">92</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-12 shrink-0 py-4 text-center text-xs text-[#98A2B3]">2</span>
                            <span class="flex-1 pl-4 text-sm font-medium">Mariam Adel</span>
                            <span class="mr-4 hidden h-1.5 w-24 overflow-hidden rounded-full bg-[#EAECF0] sm:block">
                                <span class="block h-full rounded-full bg-[#2B3FD6]" style="width: 85%"></span>
                            </span>
                            <span class="w-14 pr-5 text-right text-sm font-semibold tabular-nums">85</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-12 shrink-0 py-4 text-center text-xs text-[#98A2B3]">3</span>
                            <span class="flex-1 pl-4 text-sm font-medium">Youssef Samir</span>
                            <span class="mr-4 hidden h-1.5 w-24 overflow-hidden rounded-full bg-[#EAECF0] sm:block">
                                <span class="block h-full rounded-full bg-[#2B3FD6]" style="width: 78%"></span>
                            </span>
                            <span class="w-14 pr-5 text-right text-sm font-semibold tabular-nums">78</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-12 shrink-0 py-4 text-center text-xs text-[#98A2B3]">4</span>
                            <span class="flex-1 pl-4 text-sm font-medium">Nour Khaled</span>
                            <span class="mr-4 hidden h-1.5 w-24 overflow-hidden rounded-full bg-[#EAECF0] sm:block">
                                <span class="block h-full rounded-full bg-[#FFB400]" style="width: 64%"></span>
                            </span>
                            <span class="w-14 pr-5 text-right text-sm font-semibold tabular-nums">64</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-12 shrink-0 py-4 text-center text-xs text-[#98A2B3]">5</span>
                            <span class="flex-1 pl-4 text-sm font-medium">Salma Mostafa</span>
                            <span class="mr-4 hidden h-1.5 w-24 overflow-hidden rounded-full bg-[#EAECF0] sm:block">
                                <span class="block h-full rounded-full bg-[#2B3FD6]" style="width: 88%"></span>
                            </span>
                            <span class="w-14 pr-5 text-right text-sm font-semibold tabular-nums">88</span>
                        </li>
                    </ul>

                    <p class="border-t border-[#D9DFEA] bg-[#F9FAFB] px-5 py-2.5 text-xs text-[#667085]">
                        Sample data for illustration
                    </p>
                </div>
            </section>

            {{-- What it does --}}
            <section class="border-t border-[#D9DFEA] bg-white">
                <div class="mx-auto grid max-w-6xl divide-y divide-[#D9DFEA] md:grid-cols-3 md:divide-x md:divide-y-0">
                    <div class="px-6 py-8">
                        <h2 class="text-base font-semibold">Student records</h2>
                        <p class="mt-2 max-w-xs text-sm leading-relaxed text-[#475467]">
                            Keep each student's details in one profile instead of scattered spreadsheets.
                        </p>
                    </div>
                    <div class="px-6 py-8">
                        <h2 class="text-base font-semibold">Subjects</h2>
                        <p class="mt-2 max-w-xs text-sm leading-relaxed text-[#475467]">
                            Create and edit the subjects your school teaches. Deleting asks for confirmation first.
                        </p>
                    </div>
                    <div class="px-6 py-8">
                        <h2 class="text-base font-semibold">Role-based access</h2>
                        <p class="mt-2 max-w-xs text-sm leading-relaxed text-[#475467]">
                            Students, parents, teachers and admins each get their own dashboard and see only what their role allows.
                        </p>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-white">
            <div class="mx-auto max-w-6xl border-t border-[#D9DFEA] px-6 py-5 text-xs text-[#667085]">
                &copy; {{ date('Y') }} Student System
            </div>
        </footer>
    </body>
</html>
