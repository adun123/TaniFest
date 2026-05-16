<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/70 bg-[#fff8ec]/90 backdrop-blur-xl">
    <div class="market-container">
        <div class="flex min-h-20 items-center gap-4">
            <div class="flex items-center gap-8">
                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3">
                    <x-application-logo class="block h-11 w-auto fill-current text-[#15452f]" />
                </a>
                <div class="hidden items-center gap-2 lg:flex">
                    <x-nav-link :href="route('customer.category.semua')" :active="request()->routeIs('kategori') || request()->routeIs('customer.category*')">{{ __('Kategori') }}</x-nav-link>
                    <x-nav-link :href="route('customer.reseps.index')" :active="request()->routeIs('reseps.index') || request()->routeIs('customer.reseps*')">{{ __('Resep') }}</x-nav-link>
                    <x-nav-link :href="route('transactions.history')" :active="request()->routeIs('pesanan') || request()->routeIs('transactions.history')">{{ __('Pesanan') }}</x-nav-link>
                </div>
            </div>

            <div class="flex flex-1 items-center justify-end gap-3">
                <form action="{{ route('customer.search') }}" method="GET" class="hidden w-full max-w-xl md:block">
                    <div class="relative">
                        <input type="text" name="q" id="search" class="market-input w-full pl-5 pr-12" placeholder="Cari sayur, daging, bumbu, atau resep...">
                        <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-[#66725f]">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                </form>

                <a href="{{ route('cart.index') }}" class="relative inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/80 text-[#256f46] shadow-sm transition hover:bg-[#edf4df]" aria-label="Keranjang">
                    <i class="fa-solid fa-basket-shopping"></i>
                </a>
                <a href="#" class="hidden h-11 w-11 items-center justify-center rounded-full bg-white/80 text-[#256f46] shadow-sm transition hover:bg-[#edf4df] sm:inline-flex" aria-label="Pesan">
                    <i class="fa-regular fa-comment-dots"></i>
                </a>

                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48" contentClasses="p-2 bg-white/95 backdrop-blur rounded-2xl">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 rounded-full bg-[#15452f] px-3 py-2 text-sm font-bold text-white shadow-lg shadow-green-950/20 transition hover:bg-[#256f46] focus:outline-none">
                                <span class="hidden max-w-28 truncate md:inline">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-user-gear"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <button @click="open = ! open" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/80 text-[#256f46] shadow-sm transition hover:bg-[#edf4df] lg:hidden">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div :class="{'block': open, 'hidden': ! open}" class="hidden pb-5 lg:hidden">
            <form action="{{ route('customer.search') }}" method="GET" class="mb-3 md:hidden">
                <input type="text" name="q" class="market-input w-full" placeholder="Cari produk atau resep...">
            </form>
            <div class="space-y-2">
                <x-responsive-nav-link :href="route('customer.category.semua')" :active="request()->routeIs('customer.category*')">{{ __('Kategori') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('customer.reseps.index')" :active="request()->routeIs('customer.reseps*')">{{ __('Resep') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('transactions.history')" :active="request()->routeIs('transactions.history')">{{ __('Pesanan') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
