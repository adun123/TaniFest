<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-stone-50 text-slate-900">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gradient-to-br from-stone-50 via-emerald-50 to-slate-100">
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-30 bg-slate-950/50 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" style="display: none;"></div>

        <div class="min-h-screen lg:flex">
            <x-admin-sidebar />

            <div class="min-w-0 flex-1 lg:pl-0">
                <x-admin-header :header="$header ?? null" />

                <main class="mx-auto w-full max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                    <div class="min-w-0 overflow-hidden rounded-3xl border border-white/70 bg-white/55 p-3 shadow-2xl shadow-emerald-950/5 backdrop-blur sm:p-4 lg:p-6">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
</html>
