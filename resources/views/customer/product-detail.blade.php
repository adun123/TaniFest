<x-app-layout>
    <section class="market-container py-10">
        <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr]">
            <div class="space-y-6">
                <div class="market-card overflow-hidden p-3">
                    <div class="h-[360px] rounded-[1.5rem] bg-[#edf4df] sm:h-[520px]">
                        @if($product->photo)<img src="{{ asset('storage/'.$product->photo) }}" alt="{{ $product->nama }}" class="h-full w-full rounded-[1.5rem] object-contain">@else<div class="market-image-fallback">No Image</div>@endif
                    </div>
                </div>
                @if($product->photoGallery())
                    <div class="flex flex-wrap gap-3">@foreach($product->photoGallery() as $photo)<div class="h-24 w-24 overflow-hidden rounded-2xl border border-white/80 bg-white shadow-sm"><img src="{{ asset('storage/'.$photo) }}" alt="{{ $product->nama }}" class="h-full w-full object-cover"></div>@endforeach</div>
                @endif
                <div class="market-card-soft p-5">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-3"><img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Penjual" class="h-14 w-14 rounded-full border-2 border-[#256f46] object-cover"><div><p class="font-black">Toko Sehat Alami</p><p class="text-sm text-[#66725f]">Aktif 1 jam yang lalu</p></div></div>
                        <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20produk%20{{ urlencode($product->nama) }}%20di%20toko%20Anda" target="_blank" class="market-button">Hubungi Penjual</a>
                    </div>
                </div>
                <div class="market-card-soft p-6"><p class="market-eyebrow">Detail produk</p><h2 class="mt-2 text-2xl font-black">Deskripsi</h2><p class="mt-3 leading-7 text-[#3f503c]">{{ $product->description }}</p></div>
            </div>
            <div class="space-y-6 lg:sticky lg:top-28 lg:self-start">
                <div class="market-card p-6 sm:p-8">
                    <p class="market-eyebrow">{{ $product->category }}</p><h1 class="mt-2 text-4xl font-black leading-tight tracking-tight sm:text-5xl">{{ $product->nama }}</h1>
                    <div class="mt-4 flex items-center justify-between gap-3"><div class="font-black text-[#dba84b]">4.8 / 5</div><span class="text-sm font-bold text-[#66725f]">Ulasan (1440)</span></div>
                    <p class="mt-6 text-4xl font-black text-[#256f46]">Rp {{ number_format($product->harga) }}</p>
                    @if($product->variantOptions())
                        <label class="mt-8 block text-sm font-black uppercase tracking-[0.16em] text-[#66725f]">Pilih Varian dan Catatan:</label>
                        <div class="mt-3 flex flex-wrap gap-2">@foreach($product->variantOptions() as $variant)<button type="button" onclick="selectVariant('{{ $variant }}')" class="variant-btn market-chip">{{ $variant }}</button>@endforeach</div>
                    @endif
                    <form action="{{ route('cart.store', $product) }}" method="POST" id="addToCartForm" class="mt-6 space-y-5">
                        @csrf
                        <input type="hidden" name="variant" id="selectedVariant">
                        <input type="text" name="note" placeholder="Tambah Catatan" class="market-input w-full">
                        <div class="flex flex-wrap items-center gap-4"><label class="font-black">Jumlah:</label><div class="flex items-center rounded-full border border-[#dfe8cf] bg-white px-3 py-2"><button type="button" id="decreaseQty" class="px-3 text-lg font-black">-</button><input type="number" name="quantity" id="quantityInput" value="1" min="1" max="{{ $product->jumlah }}" class="w-14 border-0 bg-transparent text-center focus:ring-0"><button type="button" id="increaseQty" class="px-3 text-lg font-black">+</button></div><p class="text-sm font-semibold text-[#66725f]">{{ $product->jumlah }} Stok Tersedia</p></div>
                        <button type="submit" class="market-button w-full">+ Keranjang</button>
                    </form>
                </div>
                <div class="market-card-soft p-6"><h3 class="text-xl font-black text-[#256f46]">Produk Serupa</h3><div class="mt-4 grid grid-cols-2 gap-3">@foreach ($relatedProducts as $related)<div class="rounded-2xl bg-white p-3 shadow-sm"><img src="{{ asset('storage/' . $related->photo) }}" alt="{{ $related->nama }}" class="h-32 w-full rounded-xl object-cover"><p class="mt-2 truncate text-sm font-black">{{ $related->nama }}</p><p class="text-sm font-bold text-[#256f46]">Rp {{ number_format($related->harga) }}</p></div>@endforeach</div></div>
                <div class="market-card-soft p-6"><div class="flex items-center gap-3"><div class="font-black text-[#dba84b]">4.0 / 5</div><p class="text-2xl font-black">4.0</p></div><div class="mt-4 space-y-2 text-sm text-[#66725f]"><div class="flex items-center gap-2"><span>5</span><div class="h-2 w-1/2 rounded bg-[#256f46]"></div><span>25</span></div><div class="flex items-center gap-2"><span>4</span><div class="h-2 w-1/2 rounded bg-[#256f46]"></div><span>9</span></div><div class="flex items-center gap-2"><span>3</span><div class="h-2 w-1/3 rounded bg-[#256f46]"></div><span>4</span></div><div class="flex items-center gap-2"><span>2</span><div class="h-2 w-1/5 rounded bg-[#256f46]"></div><span>1</span></div><div class="flex items-center gap-2"><span>1</span><div class="h-2 w-1/5 rounded bg-[#256f46]"></div><span>1</span></div></div></div>
            </div>
        </div>
    </section>
    <script>function selectVariant(variant) { document.getElementById('selectedVariant').value = variant; document.querySelectorAll('.variant-btn').forEach(btn => { btn.classList.remove('bg-green-500', 'text-white'); }); event.target.classList.add('bg-green-500', 'text-white'); }</script>
    <script>document.getElementById('decreaseQty').addEventListener('click', function() { let qtyInput = document.getElementById('quantityInput'); let current = parseInt(qtyInput.value); if (current > 1) qtyInput.value = current - 1; }); document.getElementById('increaseQty').addEventListener('click', function() { let qtyInput = document.getElementById('quantityInput'); let max = parseInt(qtyInput.max); let current = parseInt(qtyInput.value); if (current < max) qtyInput.value = current + 1; });</script>
</x-app-layout>
