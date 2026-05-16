@php $kategoriAktif = request('kategori'); @endphp
<x-app-layout>
    <section class="market-container py-8">
        <div class="overflow-hidden rounded-[2rem] shadow-[0_30px_80px_rgba(59,74,43,0.16)]"><img src="{{ asset('img/listsemua.svg') }}" alt="Banner" class="h-64 w-full object-cover" /></div>
        <div class="mt-8 flex flex-wrap gap-3">
            @foreach (['semua' => 'Semua', 'Sayuran Hijau' => 'Sayuran Hijau', 'cabai' => 'Cabai', 'Bawang' => 'Bawang', 'rempah' => 'Rempah','Daging'=>'Daging', 'lainnya' => 'Lainnya'] as $key => $label)
                <a href="{{ route('customer.category', ['kategori' => $key]) }}" class="market-chip {{ $kategoriAktif == $key ? 'market-chip-active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>
        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
            @forelse($products as $product)
                <div class="market-product-card">
                    <a href="{{ route('product.detail', $product) }}" class="block h-48 overflow-hidden bg-[#edf4df]">@if($product->photo)<img src="{{ asset('storage/'.$product->photo) }}" alt="{{ $product->nama }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">@else<div class="market-image-fallback">No Image</div>@endif</a>
                    <div class="p-4"><h3 class="truncate text-lg font-black"><a href="{{ route('product.detail', $product) }}">{{ $product->nama }}</a></h3><p class="mt-1 text-sm text-[#66725f]">{{ $product->category }}</p><p class="mt-4 text-lg font-black text-[#256f46]">Rp {{ number_format($product->harga) }}</p><p class="text-xs font-semibold {{ $product->jumlah > 0 ? 'text-[#256f46]' : 'text-red-600' }}">{{ $product->jumlah > 0 ? $product->jumlah.' tersedia' : 'Habis' }}</p></div>
                </div>
            @empty
                <div class="col-span-full market-card p-10 text-center"><h3 class="text-xl font-black">Tidak ada produk yang tersedia</h3><p class="mt-2 text-[#66725f]">Coba filter lain untuk menemukan hasil panen segar.</p></div>
            @endforelse
        </div>
    </section>
</x-app-layout>
