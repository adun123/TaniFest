<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <footer class="bg-white text-gray-700">
  <!-- Garis atas -->
  <div class="border-t w-full"></div>

  <!-- Konten Utama Footer -->
  <div class="max-w-7xl mx-auto px-4 py-6">
    <div class="footer-content">
      <h5 class="text-lg font-bold mb-2">GET CONNECTED</h5>
      <p class="text-sm leading-relaxed">
        Bandung<br />
        Indonesia<br />
        <a href="/profile_company" class="text-green-600 hover:underline">Tentang TANIFEAST</a><br />
        0821-9898-9090<br />
        support@tanifeast.com
      </p>
    </div>
  </div>

  <!-- Garis bawah -->
  <div class="border-t w-full"></div>

  <!-- Copyright -->
  <div class="max-w-7xl mx-auto px-4 py-3 text-center text-sm text-gray-500">
    <p>© 2024 TANI FEAST - All rights reserved - Made in Bandung</p>
  </div>
</footer>

    <!-- Hanya load Alpine.js sekali saja -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    
    <!-- Bootstrap JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>