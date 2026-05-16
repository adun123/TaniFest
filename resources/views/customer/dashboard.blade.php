@php
    $kategoriAktif = request('kategori');
@endphp
<x-app-layout>
    <section class="market-container py-8">
        <div id="hero" class="carousel slide overflow-hidden rounded-[2rem] shadow-[0_30px_80px_rgba(59,74,43,0.18)]" data-bs-ride="true" data-bs-theme="dark">
            <div class="carousel-inner">
                <div class="carousel-item active"><img src="{{ asset('images/banner1.svg') }}" class="h-[220px] w-100 object-cover sm:h-[360px]" alt="Tani Feast banner" /></div>
                <div class="carousel-item"><img src="{{ asset('images/banner2.svg') }}" class="h-[220px] w-100 object-cover sm:h-[360px]" alt="Tani Feast banner" /></div>
                <div class="carousel-item"><img src="{{ asset('images/banner1.svg') }}" class="h-[220px] w-100 object-cover sm:h-[360px]" alt="Tani Feast banner" /></div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#hero" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#hero" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
            <div class="carousel-indicators"><button type="button" data-bs-target="#hero" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button><button type="button" data-bs-target="#hero" data-bs-slide-to="1" aria-label="Slide 2"></button><button type="button" data-bs-target="#hero" data-bs-slide-to="2" aria-label="Slide 3"></button></div>
        </div>
    </section>

    <section class="market-container py-6">
        <div class="market-section-title mb-5">
            <div><p class="market-eyebrow">Limited harvest</p><h2 class="market-heading">Diskon Spesial</h2></div>
            <div class="flex items-center gap-2 text-sm font-bold text-[#b9572d]">Berakhir pada <span class="rounded-full bg-[#b9572d] px-3 py-1 text-white">03</span><span class="rounded-full bg-[#b9572d] px-3 py-1 text-white">18</span><span class="rounded-full bg-[#b9572d] px-3 py-1 text-white">59</span></div>
        </div>
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
            @forelse ($discountedProducts as $product)
                <div class="market-product-card">
                    <div class="h-36 overflow-hidden bg-[#edf4df]">@if($product->photo)<img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->nama }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">@else<div class="market-image-fallback">Fresh Pick</div>@endif</div>
                    <div class="p-4"><p class="truncate text-sm font-black">{{ $product->nama }}</p><p class="mt-1 text-xs text-[#66725f]">{{ $product->variantLabel() }}</p><p class="mt-3 font-black text-[#256f46]">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p></div>
                </div>
            @empty
                <div class="col-span-full market-card-soft p-8 text-center text-[#66725f]">Belum ada diskon hari ini.</div>
            @endforelse
        </div>
    </section>

    <section class="market-container py-8">
        <div class="market-section-title mb-5"><div><p class="market-eyebrow">Shop by mood</p><h2 class="market-heading">Kategori Pilihan</h2></div><a href="{{ route('customer.category.semua') }}" class="market-button-outline">Lihat lainnya</a></div>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            @foreach ($categories->unique('title')->take(4) as $category)
                <a href="#" class="group relative block h-44 overflow-hidden rounded-[1.75rem] shadow-lg">
                    <img src="{{ asset('storage/' . $category->image_url) }}" alt="{{ $category->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#15452f]/85 via-[#15452f]/25 to-transparent"></div>
                    <h3 class="absolute bottom-5 left-5 right-5 text-xl font-black text-white">{{ $category->title }}</h3>
                </a>
            @endforeach
        </div>
    </section>

    <section class="market-container py-8">
        <div class="market-section-title mb-5"><div><p class="market-eyebrow">Cook better</p><h2 class="market-heading">Inspirasi Untuk Kamu</h2></div><a href="{{ route('customer.reseps.index')}}" class="market-button-outline">Cek resep lainnya</a></div>
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-7">
            @forelse ($reseps->take(7) as $resep)
                <div class="relative h-44 overflow-hidden rounded-[1.5rem] shadow-lg"><img src="{{ asset('storage/' . $resep->foto) }}" alt="{{ $resep->nama }}" class="h-full w-full object-cover"><div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/70 to-transparent p-4"><span class="text-sm font-black text-white">{{ $resep->nama }}</span></div></div>
            @empty
                <div class="col-span-full market-card-soft p-8 text-center text-[#66725f]">Belum ada resep tersedia.</div>
            @endforelse
        </div>
    </section>

    <section class="market-container py-8 pb-14">
        <div class="market-section-title mb-5"><div><p class="market-eyebrow">Today at the market</p><h2 class="market-heading">Produk Terbaik Hari Ini</h2></div></div>
        <div class="mb-6 flex flex-wrap gap-3">
            @foreach (['semua' => 'Semua', 'Sayuran Hijau' => 'Sayuran Hijau', 'cabai' => 'Cabai', 'Bawang' => 'Bawang', 'rempah' => 'Rempah', 'lainnya' => 'Lainnya'] as $key => $label)
                <a href="{{ route('customer.dashboard', ['kategori' => $key]) }}" class="market-chip {{ $kategoriAktif == $key ? 'market-chip-active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
            @forelse($products as $product)
                <div class="market-product-card">
                    <a href="{{ route('product.detail', $product) }}" class="block h-48 overflow-hidden bg-[#edf4df]">@if($product->photo)<img src="{{ asset('storage/'.$product->photo) }}" alt="{{ $product->nama }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">@else<div class="market-image-fallback">No Image</div>@endif</a>
                    <div class="p-4"><h3 class="truncate text-lg font-black"><a href="{{ route('product.detail', $product) }}">{{ $product->nama }}</a></h3><p class="mt-1 text-sm text-[#66725f]">{{ $product->variantLabel() }}</p><p class="mt-4 text-lg font-black text-[#256f46]">Rp {{ number_format($product->harga) }}</p><p class="text-xs font-semibold {{ $product->jumlah > 0 ? 'text-[#256f46]' : 'text-red-600' }}">{{ $product->jumlah > 0 ? $product->jumlah.' tersedia' : 'Habis' }}</p></div>
                </div>
            @empty
                <div class="col-span-full market-card p-10 text-center"><h3 class="text-xl font-black">Tidak ada produk yang tersedia</h3><p class="mt-2 text-[#66725f]">Coba kategori lain atau kembali lagi nanti.</p></div>
            @endforelse
        </div>
    </section>
</x-app-layout>
