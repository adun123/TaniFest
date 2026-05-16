<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Tani Feast') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-[#243126] antialiased">
    <div class="min-h-screen market-shell px-4 py-8 sm:flex sm:items-center sm:justify-center">
        <div class="w-full max-w-md">
            <a href="/" class="mx-auto mb-6 flex w-fit items-center justify-center rounded-full bg-white/80 p-4 shadow-lg">
                <x-application-logo class="h-14 w-auto fill-current text-[#15452f]" />
            </a>
            <div class="market-card p-6 sm:p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
