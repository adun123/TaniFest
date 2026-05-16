<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>{{ config('app.name', 'Tani Feast') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-[#243126]">
    <div class="min-h-screen market-shell">
        @include('layouts.navigation')

        @isset($header)
            <header class="border-b border-white/70 bg-white/70 backdrop-blur">
                <div class="market-container py-6">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>

    <footer class="border-t border-[#dfe8cf] bg-[#15452f] text-[#fff8ec]">
        <div class="market-container py-10">
            <div class="grid gap-8 md:grid-cols-[1.4fr_1fr_1fr]">
                <div>
                    <p class="market-eyebrow text-[#dba84b]">Fresh from Bandung</p>
                    <h2 class="mt-2 text-3xl font-black tracking-tight">TANI FEAST</h2>
                    <p class="mt-3 max-w-md text-sm leading-6 text-white/75">Belanja bahan segar, resep inspiratif, dan kebutuhan dapur harian dalam satu pengalaman pasar modern.</p>
                </div>
                <div>
                    <h3 class="text-sm font-black uppercase tracking-[0.2em] text-[#dba84b]">GET CONNECTED</h3>
                    <p class="mt-3 text-sm leading-6 text-white/75">Bandung, Indonesia<br>0821-9898-9090<br>support@tanifeast.com</p>
                </div>
                <div>
                    <h3 class="text-sm font-black uppercase tracking-[0.2em] text-[#dba84b]">Company</h3>
                    <a href="/profile_company" class="mt-3 inline-flex text-sm font-semibold text-white hover:text-[#dba84b]">Tentang TANIFEAST</a>
                </div>
            </div>
            <div class="mt-8 border-t border-white/10 pt-5 text-center text-xs text-white/60">&copy; 2024 TANI FEAST - All rights reserved - Made in Bandung</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
