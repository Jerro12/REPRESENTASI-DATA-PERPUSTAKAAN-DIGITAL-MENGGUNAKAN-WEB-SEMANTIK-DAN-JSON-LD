<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }

        .scroll-mt-24 {
            scroll-margin-top: 6rem;
        }
    </style>
</head>

<body class="font-sans antialiased bg-[#FFFFFF] text-[#718096]">
    {{-- Halaman Auth --}}
    @if (request()->routeIs('login', 'register', 'password.*'))
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-[#1dc2fe]" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-[#FFFFFF] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border border-[#F1F5F9] overflow-hidden sm:rounded-lg text-[#1A202C]">
                {{ $slot }}
            </div>
        </div>
    @else
        {{-- Landing page / guest --}}
        <div class="min-h-screen bg-[#FFFFFF] text-[#718096]">
            {{ $slot }}
        </div>
    @endif
</body>

</html>