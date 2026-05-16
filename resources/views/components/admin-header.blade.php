@props(['header' => null])

<header class="sticky top-0 z-20 border-b border-white/70 bg-white/80 shadow-sm shadow-emerald-950/5 backdrop-blur-xl">
    <div class="flex items-center justify-between gap-3 px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button type="button" class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl border border-emerald-100 bg-white text-emerald-800 shadow-sm lg:hidden" @click="sidebarOpen = true" aria-label="Buka menu admin">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="min-w-0">
                <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">TaniFest Admin</p>
                <h1 class="truncate text-xl font-black tracking-tight text-slate-950 sm:text-2xl">
                    {{ $header ?? 'Admin Dashboard' }}
                </h1>
            </div>
        </div>
        
        <div class="flex shrink-0 items-center gap-2 sm:gap-3">
            <div class="hidden rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-900 md:block">
                Operasional Produk
            </div>
            
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-2 py-2 shadow-sm transition hover:border-emerald-200 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 sm:px-3">
                    @auth
                        <span class="hidden text-right sm:block">
                            <span class="block text-sm font-bold leading-tight text-slate-900">{{ Auth::user()->name }}</span>
                            <span class="block text-xs font-medium text-slate-500">Administrator</span>
                        </span>
                        <img class="h-10 w-10 rounded-2xl border border-emerald-100" 
                             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=064E3B&background=D1FAE5" 
                             alt="User avatar">
                    @else
                        <span class="hidden text-sm font-bold text-slate-900 sm:block">Guest</span>
                        <img class="h-10 w-10 rounded-2xl border border-emerald-100" 
                             src="https://ui-avatars.com/api/?name=Guest&color=064E3B&background=D1FAE5" 
                             alt="Guest avatar">
                    @endauth
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="open" x-transition @click.away="open = false" class="absolute right-0 z-50 mt-3 w-56 overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-2xl shadow-slate-950/10" style="display: none;">
                    <div class="border-b border-slate-100 px-4 py-3">
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Akun Admin</p>
                        @auth
                            <p class="mt-1 truncate text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                        @endauth
                    </div>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-emerald-50 hover:text-emerald-800">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-3 text-left text-sm font-semibold text-red-600 transition hover:bg-red-50">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
