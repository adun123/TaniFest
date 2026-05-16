<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tani Feast</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-[var(--market-ink)]">
    <div class="min-h-screen overflow-hidden market-shell">
        <header class="relative z-20">
            <nav class="market-container flex items-center justify-between py-5">
                <a href="/" class="flex items-center gap-3 rounded-full bg-white/80 px-4 py-3 shadow-lg shadow-green-950/10 backdrop-blur" aria-label="Tani Feast home">
                    <img src="{{ asset('images/logo.svg') }}" alt="Tani Feast" class="h-10 w-auto">
                    <span class="hidden text-sm font-black uppercase tracking-[0.22em] text-[var(--market-leaf-dark)] sm:inline">Tani Feast</span>
                </a>

                @if (Route::has('login'))
                    <div class="flex items-center gap-2 sm:gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="market-button px-4 py-2 sm:px-5 sm:py-3">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="market-button-outline px-4 py-2 sm:px-5 sm:py-3">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="market-button px-4 py-2 sm:px-5 sm:py-3">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </header>

        <main>
            <section class="market-container relative py-10 sm:py-14 lg:py-20">
                <div class="pointer-events-none absolute -right-24 top-0 h-72 w-72 rounded-full bg-[var(--market-gold)]/20 blur-3xl"></div>
                <div class="pointer-events-none absolute -left-24 bottom-10 h-80 w-80 rounded-full bg-[var(--market-sage)]/70 blur-3xl"></div>

                <div class="grid items-center gap-10 lg:grid-cols-[1.02fr_0.98fr]">
                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-3 rounded-full border border-white/80 bg-white/80 px-4 py-2 shadow-sm backdrop-blur">
                            <span class="h-2.5 w-2.5 rounded-full bg-[var(--market-clay)]"></span>
                            <span class="text-xs font-black uppercase tracking-[0.24em] text-[var(--market-clay)]">Fresh from Bandung</span>
                        </div>

                        <h1 class="mt-6 max-w-4xl text-5xl font-black leading-[0.95] tracking-tight text-[var(--market-ink)] sm:text-6xl lg:text-7xl">
                            Pasar segar harian untuk dapur yang lebih hidup.
                        </h1>
                        <p class="mt-6 max-w-2xl text-lg leading-8 text-[var(--market-muted)]">
                            Tani Feast menghubungkan hasil panen, bumbu, daging, dan resep rumahan dalam pengalaman ecommerce yang hangat, cepat, dan mudah dipakai.
                        </p>

                        @if (Route::has('login'))
                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="market-button w-full sm:w-auto">Masuk ke dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="market-button w-full sm:w-auto">Mulai belanja</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="market-button-outline w-full sm:w-auto">Buat akun baru</a>
                                    @endif
                                @endauth
                            </div>
                        @endif

                        <div class="mt-10 grid grid-cols-3 gap-3 sm:max-w-2xl sm:gap-4">
                            <div class="market-card-soft p-4">
                                <p class="text-2xl font-black text-[var(--market-leaf)]">120+</p>
                                <p class="mt-1 text-xs font-bold uppercase tracking-[0.14em] text-[var(--market-muted)]">Fresh items</p>
                            </div>
                            <div class="market-card-soft p-4">
                                <p class="text-2xl font-black text-[var(--market-leaf)]">24h</p>
                                <p class="mt-1 text-xs font-bold uppercase tracking-[0.14em] text-[var(--market-muted)]">Daily stock</p>
                            </div>
                            <div class="market-card-soft p-4">
                                <p class="text-2xl font-black text-[var(--market-leaf)]">4.8</p>
                                <p class="mt-1 text-xs font-bold uppercase tracking-[0.14em] text-[var(--market-muted)]">Market love</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10">
                        <div class="market-card relative overflow-hidden p-4 sm:p-5">
                            <div class="absolute inset-x-0 top-0 h-28 bg-gradient-to-b from-[var(--market-sage)]/70 to-transparent"></div>
                            <div class="relative overflow-hidden rounded-[1.5rem] bg-[var(--market-leaf-dark)] p-5 text-[var(--market-cream)] sm:p-7">
                                <div class="absolute -right-14 -top-14 h-36 w-36 rounded-full bg-[var(--market-gold)]/30 blur-2xl"></div>
                                <div class="absolute -bottom-16 left-6 h-44 w-44 rounded-full bg-[var(--market-leaf)]/70 blur-3xl"></div>

                                <div class="relative flex items-start justify-between gap-5">
                                    <div>
                                        <p class="text-xs font-black uppercase tracking-[0.24em] text-[var(--market-gold)]">Today basket</p>
                                        <h2 class="mt-3 text-3xl font-black leading-tight sm:text-4xl">Panen pagi siap masuk keranjang.</h2>
                                    </div>
                                    <div class="rounded-full bg-white/15 px-4 py-2 text-sm font-black backdrop-blur">-18%</div>
                                </div>

                                <div class="relative mt-8 grid grid-cols-3 gap-3">
                                    <div class="rounded-[1.25rem] bg-white/90 p-3 shadow-lg shadow-green-950/20">
                                        <img src="{{ asset('images/bayam.svg') }}" alt="Bayam" class="mx-auto h-24 object-contain">
                                        <p class="mt-2 truncate text-sm font-black text-[var(--market-ink)]">Bayam</p>
                                        <p class="text-xs font-bold text-[var(--market-leaf)]">Fresh</p>
                                    </div>
                                    <div class="translate-y-6 rounded-[1.25rem] bg-white/90 p-3 shadow-lg shadow-green-950/20">
                                        <img src="{{ asset('images/cabemerah.svg') }}" alt="Cabai merah" class="mx-auto h-24 object-contain">
                                        <p class="mt-2 truncate text-sm font-black text-[var(--market-ink)]">Cabai</p>
                                        <p class="text-xs font-bold text-[var(--market-clay)]">Pedas</p>
                                    </div>
                                    <div class="rounded-[1.25rem] bg-white/90 p-3 shadow-lg shadow-green-950/20">
                                        <img src="{{ asset('images/wortel.svg') }}" alt="Wortel" class="mx-auto h-24 object-contain">
                                        <p class="mt-2 truncate text-sm font-black text-[var(--market-ink)]">Wortel</p>
                                        <p class="text-xs font-bold text-[var(--market-gold)]">Manis</p>
                                    </div>
                                </div>

                                <div class="relative mt-12 rounded-[1.5rem] border border-white/15 bg-white/10 p-4 backdrop-blur">
                                    <div class="flex items-center justify-between gap-4">
                                        <div>
                                            <p class="text-sm font-black">Paket sayur keluarga</p>
                                            <p class="mt-1 text-xs text-[var(--market-cream)]/75">Sayuran hijau, bumbu, dan resep mingguan.</p>
                                        </div>
                                        <span class="rounded-full bg-[var(--market-gold)] px-3 py-1 text-sm font-black text-[var(--market-ink)]">Rp 79k</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="market-container py-8 sm:py-12">
                <div class="market-section-title mb-6">
                    <div>
                        <p class="market-eyebrow">Shop by mood</p>
                        <h2 class="market-heading">Kategori favorit pasar</h2>
                    </div>
                    <p class="market-subtle max-w-xl">Dibentuk seperti lorong pasar modern: cepat dipindai, kaya warna, dan selalu terasa segar.</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <article class="market-product-card p-5">
                        <div class="flex h-36 items-center justify-center rounded-[1.25rem] bg-[var(--market-sage)]/80">
                            <img src="{{ asset('images/sayurhijau.svg') }}" alt="Sayuran hijau" class="h-28 object-contain">
                        </div>
                        <h3 class="mt-4 text-xl font-black">Sayuran hijau</h3>
                        <p class="mt-2 text-sm leading-6 text-[var(--market-muted)]">Bayam, selada, daun bawang, dan panen renyah untuk menu harian.</p>
                    </article>
                    <article class="market-product-card p-5">
                        <div class="flex h-36 items-center justify-center rounded-[1.25rem] bg-[var(--market-cream-2)]">
                            <img src="{{ asset('images/bawang.svg') }}" alt="Bawang" class="h-28 object-contain">
                        </div>
                        <h3 class="mt-4 text-xl font-black">Bumbu dapur</h3>
                        <p class="mt-2 text-sm leading-6 text-[var(--market-muted)]">Bawang, cabai, rempah, dan aroma dasar untuk masakan rumah.</p>
                    </article>
                    <article class="market-product-card p-5">
                        <div class="flex h-36 items-center justify-center rounded-[1.25rem] bg-[var(--market-sage)]/80">
                            <img src="{{ asset('images/daging.svg') }}" alt="Daging" class="h-28 object-contain">
                        </div>
                        <h3 class="mt-4 text-xl font-black">Protein pilihan</h3>
                        <p class="mt-2 text-sm leading-6 text-[var(--market-muted)]">Daging dan ikan untuk stok makan siang, malam, atau meal prep.</p>
                    </article>
                    <article class="market-product-card p-5">
                        <div class="flex h-36 items-center justify-center rounded-[1.25rem] bg-[var(--market-cream-2)]">
                            <img src="{{ asset('images/bundle.svg') }}" alt="Paket bahan" class="h-28 object-contain">
                        </div>
                        <h3 class="mt-4 text-xl font-black">Paket resep</h3>
                        <p class="mt-2 text-sm leading-6 text-[var(--market-muted)]">Belanja bahan sesuai inspirasi resep agar masak tetap praktis.</p>
                    </article>
                </div>
            </section>

            <section class="market-container py-8 pb-16 sm:py-12 sm:pb-20">
                <div class="grid gap-5 lg:grid-cols-[0.85fr_1.15fr]">
                    <div class="market-card p-6 sm:p-8">
                        <p class="market-eyebrow">How it works</p>
                        <h2 class="mt-2 text-3xl font-black leading-tight tracking-tight sm:text-4xl">Dari panen ke meja makan dalam tiga langkah.</h2>
                        <p class="mt-4 leading-7 text-[var(--market-muted)]">Masuk, pilih bahan atau paket resep, lalu pantau pesanan dari dashboard Tani Feast.</p>

                        @if (Route::has('login'))
                            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="market-button">Buka dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="market-button">Login sekarang</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="market-button-outline">Daftar gratis</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="market-card-soft p-5">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[var(--market-leaf)] text-sm font-black text-white">01</span>
                            <h3 class="mt-5 text-lg font-black">Pilih panen</h3>
                            <p class="mt-2 text-sm leading-6 text-[var(--market-muted)]">Cari kategori, produk diskon, atau resep yang cocok untuk hari ini.</p>
                        </div>
                        <div class="market-card-soft p-5 sm:translate-y-5">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[var(--market-clay)] text-sm font-black text-white">02</span>
                            <h3 class="mt-5 text-lg font-black">Racik keranjang</h3>
                            <p class="mt-2 text-sm leading-6 text-[var(--market-muted)]">Atur varian, jumlah, dan catatan belanja dalam alur yang ringan.</p>
                        </div>
                        <div class="market-card-soft p-5">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[var(--market-gold)] text-sm font-black text-[var(--market-ink)]">03</span>
                            <h3 class="mt-5 text-lg font-black">Nikmati segar</h3>
                            <p class="mt-2 text-sm leading-6 text-[var(--market-muted)]">Pesanan dan inspirasi masak tersimpan rapi di dashboard.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
