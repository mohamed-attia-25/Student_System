@props(['title' => '', 'subtitle' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen grid lg:grid-cols-2">

            <!-- Left: Brand panel -->
            <div class="relative hidden lg:flex flex-col justify-between overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-700 to-indigo-900 p-12 text-white">
                <div class="absolute -top-24 -right-24 h-96 w-96 rounded-full bg-white/10"></div>
                <div class="absolute top-1/2 -left-32 h-80 w-80 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-32 right-10 h-96 w-96 rounded-full bg-indigo-400/20 blur-3xl"></div>

                <a href="/" class="relative flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white p-2 shadow-lg">
                        <img src="{{ asset('images/student-svgrepo-com.svg') }}" alt="logo" class="h-full w-full">
                    </span>
                    <span class="text-2xl font-bold tracking-tight">StudentSystem</span>
                </a>

                <div class="relative max-w-md">
                    <h2 class="text-4xl font-extrabold leading-tight">
                        Manage your students,<br>courses and grades in one place.
                    </h2>
                    <p class="mt-4 text-indigo-100">
                        A simple and powerful platform built for modern education.
                    </p>

                    <ul class="mt-8 space-y-4">
                        @foreach (['Track student records effortlessly', 'Organize courses and enrollments', 'Secure access with role-based permissions'] as $feature)
                            <li class="flex items-center gap-3">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/20">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                <span class="text-indigo-50">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <p class="relative text-sm text-indigo-200">&copy; {{ date('Y') }} Student System</p>
            </div>

            <!-- Right: Form panel -->
            <div class="flex flex-col justify-center bg-white px-6 py-12 sm:px-12 lg:px-20">
                <div class="mx-auto w-full max-w-md">

                    <!-- Mobile logo -->
                    <a href="/" class="mb-8 flex items-center gap-3 lg:hidden">
                        <img src="{{ asset('images/student-svgrepo-com.svg') }}" alt="logo" class="h-10 w-10">
                        <span class="text-xl font-bold tracking-tight text-gray-800">
                            Student<span class="text-indigo-600">System</span>
                        </span>
                    </a>

                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $title }}</h1>
                    <p class="mt-2 text-gray-500">{{ $subtitle }}</p>

                    <div class="mt-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
