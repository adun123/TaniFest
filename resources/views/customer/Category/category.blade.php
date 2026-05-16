<x-app-layout>
    <section class="market-container py-8">
        <div class="relative overflow-hidden rounded-[2rem] bg-[#15452f] shadow-[0_30px_80px_rgba(59,74,43,0.18)]">
            <img src="{{ asset('img/kategori.svg') }}" alt="Banner" class="h-64 w-full object-cover opacity-80" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#15452f]/90 to-transparent"></div>
            <div class="absolute inset-y-0 left-0 flex max-w-xl flex-col justify-center p-8 text-white"><p class="text-xs font-black uppercase tracking-[0.28em] text-[#dba84b]">Fresh aisles</p><h1 class="mt-2 text-4xl font-black">Kategori Pilihan</h1><p class="mt-3 text-white/75">Temukan bahan terbaik untuk menu harian dan resep spesial.</p></div>
        </div>
    </section>
    <section class="market-container pb-14">
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            @forelse ($categories->unique('title') as $category)
                <a href="{{ route('customer.category') }}" class="group relative block h-48 overflow-hidden rounded-[1.75rem] shadow-lg">
                    <img src="{{ asset('storage/' . $category->image_url) }}" alt="{{ $category->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#15452f]/85 via-[#15452f]/25 to-transparent"></div><h3 class="absolute bottom-5 left-5 right-5 text-xl font-black text-white">{{ $category->title }}</h3>
                </a>
            @empty
                <div class="col-span-full market-card p-10 text-center text-[#66725f]">Belum ada kategori tersedia.</div>
            @endforelse
        </div>
    </section>
</x-app-layout>
