<aside class="fixed inset-y-0 left-0 z-40 flex w-72 -translate-x-full flex-col overflow-y-auto bg-gradient-to-b from-emerald-950 via-emerald-900 to-slate-950 px-4 py-5 text-white shadow-2xl shadow-emerald-950/30 transition duration-300 lg:sticky lg:top-0 lg:h-screen lg:!translate-x-0" :class="sidebarOpen ? '!translate-x-0' : '-translate-x-full lg:!translate-x-0'">
    <div class="flex items-center justify-between gap-3 rounded-3xl border border-white/10 bg-white/10 p-4 shadow-inner shadow-white/5">
        <a href="{{ route('admin.dashboard') }}" class="flex min-w-0 items-center gap-3">
            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-emerald-300 text-lg font-black text-emerald-950 shadow-lg shadow-emerald-950/30">TF</span>
            <span class="min-w-0">
                <span class="block truncate text-lg font-black tracking-tight">{{ config('app.name') }}</span>
                <span class="block text-xs font-semibold uppercase tracking-widest text-emerald-200">Admin Panen</span>
            </span>
        </a>
        <button type="button" class="rounded-xl p-2 text-emerald-100 hover:bg-white/10 lg:hidden" @click="sidebarOpen = false" aria-label="Tutup menu admin">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="mt-6 rounded-3xl border border-emerald-300/20 bg-emerald-300/10 p-4">
        <p class="text-sm font-semibold text-emerald-50">Premium agricultural control room</p>
        <p class="mt-1 text-xs leading-relaxed text-emerald-100/75">Kelola produk segar, resep, dan banner kategori dalam satu ruang kerja.</p>
    </div>
    
    <nav class="mt-6 space-y-2">
        <div class="px-3 pb-2 text-xs font-bold uppercase tracking-widest text-emerald-200/80">Menu Utama</div>
        
        <x-admin-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
            <x-slot name="icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.5l8.25-8.25a1.06 1.06 0 011.5 0L21 13.5M5.25 11.25V20.25h13.5V11.25M9.75 20.25v-5.25h4.5v5.25" />
                </svg>
            </x-slot>
            Produk / Dashboard
        </x-admin-nav-link>
        
        <x-admin-nav-link href="{{ route('admin.reseps.index') }}" :active="request()->routeIs('admin.reseps.*')">
            <x-slot name="icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4.5h10.5A3.5 3.5 0 0119 8v11.5H8.5A3.5 3.5 0 015 16V4.5zM8.5 8.5h7M8.5 12h7M8.5 15.5H13" />
                </svg>
            </x-slot>
            Resep
        </x-admin-nav-link>
        <x-admin-nav-link href="{{ route('category-banners.index') }}" :active="request()->routeIs('category-banners.*')">
            <x-slot name="icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7.5A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v9A2.5 2.5 0 0117.5 19h-11A2.5 2.5 0 014 16.5v-9zM7.5 15l2.25-2.25 1.75 1.75L14.75 11 17 13.25M8.5 9h.01" />
                </svg>
            </x-slot>
            Category Banner
        </x-admin-nav-link>
    </nav>

    <div class="mt-auto pt-6">
        <div class="rounded-3xl border border-white/10 bg-white/10 p-4 text-sm text-emerald-50">
            <p class="font-bold">Ruang admin aktif</p>
            <p class="mt-1 text-xs text-emerald-100/75">Gunakan profil di header untuk pengaturan akun dan logout.</p>
        </div>
    </div>
</aside>
