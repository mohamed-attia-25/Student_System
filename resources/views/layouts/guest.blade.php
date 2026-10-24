<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative min-h-screen flex flex-col items-center justify-center px-4 py-10 bg-gradient-to-br from-indigo-50 via-white to-indigo-100 overflow-hidden">

            <!-- Decorative circles -->
            <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-indigo-200/40 blur-2xl"></div>
            <div class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-indigo-300/30 blur-2xl"></div>

            <!-- Logo -->
            <a href="/" class="relative flex flex-col items-center gap-3 group">
                <x-application-logo class="h-16 w-16 transition-transform duration-200 group-hover:scale-110" />
                <span class="text-xl font-bold tracking-tight text-gray-800">
                    Student<span class="text-indigo-600">System</span>
                </span>
            </a>

            <!-- Card -->
            <div class="relative w-full sm:max-w-md mt-8 px-8 py-8 bg-white/90 backdrop-blur-sm border border-gray-100 shadow-xl rounded-2xl">
                {{ $slot }}
            </div>

            <p class="relative mt-6 text-xs text-gray-400">
                &copy; {{ date('Y') }} Student System
            </p>
        </div>
    </body>
</html>
