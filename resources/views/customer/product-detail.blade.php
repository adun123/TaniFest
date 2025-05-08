<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $product->nama }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- KIRI: Gambar & Deskripsi -->
        <div>
            <!-- Foto Utama -->
            @if($product->photo)
                <img src="{{ asset('storage/'.$product->photo) }}" class="w-full rounded-lg shadow">
            @endif

            <!-- Foto Tambahan -->
            @if($product->photos)
                <div class="flex gap-2 mt-4">
                    @foreach(json_decode($product->photos, true) as $photo)
                        <img src="{{ asset('storage/'.$photo) }}" class="w-20 h-20 object-cover rounded border">
                    @endforeach
                </div>
            @endif

              <!-- Detail -->
            <div class="mb-6">
                <h3 class="text-lg font-bold mb-2">Detail</h3>
                <p class="mb-4">{{ $product->description }}</p>
            </div>
             <!-- Ulasan -->
             <div>
                <h3 class="text-lg font-bold mb-2">Ulasan</h3>
                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-1">Terbaru ▼</p>
                    <div class="flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full">
                        <div>
                            <p class="font-semibold">Ritatata</p>
                            <p class="text-gray-600 text-sm">Wortelnya masih fresh suka banget deh!!</p>
                        </div>
                    </div>
                </div>
                <!-- Tambahkan ulasan palsu lain jika mau -->
            </div>
        </div>
        
         <!-- KANAN: Info & Aksi -->
        <!-- Info Produk -->
        <div>
            <h1 class="text-2xl font-bold mb-2">{{ $product->nama }}</h1>
            <p class="text-gray-600 mb-4">{{ $product->category }}</p>
            <div class="flex items-center gap-2 mb-4">
                <div class="flex text-yellow-400">
                    @for ($i = 0; $i < 4; $i++)
                        ★
                    @endfor
                    ☆
                </div>
                <span class="text-sm text-green-600">Ulasan 1440</span>
            </div>
            <p class="text-black-600 text-xl font-bold mb-4">Rp {{ number_format($product->harga) }}</p>

            <p class="mb-4">{{ $product->description }}</p>

            <!-- Pilihan Varian -->
            @if($product->variants)
                <label class="block font-semibold mb-2">Pilih Varian:</label>
                <div class="flex gap-2 mb-4">
                    @foreach(json_decode($product->variants, true) as $variant)
                        <button 
                            type="button" 
                            onclick="selectVariant('{{ $variant }}')" 
                            class="variant-btn px-3 py-1 border rounded-full text-sm cursor-pointer hover:bg-green-100"
                        >
                            {{ $variant }}
                        </button>
                    @endforeach
                </div>
            @endif

              <!-- Stok & Jumlah -->
              <form action="{{ route('cart.store', $product) }}" method="POST" id="addToCartForm">
                @csrf
                <input type="hidden" name="variant" id="selectedVariant">
                
                <!-- Catatan -->
                <input type="text" name="note" placeholder="Tambah Catatan" class="border rounded w-full p-2 mb-3">
                
                <!-- Stok & Jumlah -->
                <div class="flex items-center gap-4 mb-6">
                    <label class="block font-semibold mb-2">Jumlah:</label>
                    <div class="flex items-center gap-2 border rounded px-2 py-1">
                        <button type="button" id="decreaseQty" class="text-lg">−</button>
                        <input type="number" name="quantity" id="quantityInput" value="1" min="1" max="{{ $product->jumlah }}" class="w-12 text-center">
                        <button type="button" id="increaseQty" class="text-lg">＋</button>
                    </div>
                    <p class="text-sm text-gray-600">{{ $product->jumlah }} Stok Tersedia</p>
                </div>
            
                <!-- Tombol -->
                <button type="submit" class="w-full border border-green-500 text-green-500 font-semibold py-3 rounded mb-6 hover:bg-green-50">
                    + Keranjang
                </button>
            </form>
            
            
            

            <!-- Produk Serupa -->
            <div class="mb-6">
                <h3 class="text-lg font-bold mb-2 text-green-600">Produk Serupa</h3>
                <div class="flex gap-4">
                    @foreach ($relatedProducts as $related)
                        <div class="border rounded p-2 w-32">
                            <img src="{{ asset('storage/'.$related->photo) }}" class="w-full h-20 object-cover rounded mb-1">
                            <p class="text-sm font-semibold">{{ $related->nama }}</p>
                            <p class="text-xs text-gray-600">Rp {{ number_format($related->harga) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
             <!-- Rating -->
             <div>
                <div class="flex items-center gap-2 mb-2">
                    <div class="flex text-yellow-400">★★★★☆</div>
                    <p class="text-xl font-bold">4.0</p>
                </div>
                <div class="space-y-1 text-sm text-gray-600">
                    <div class="flex items-center gap-2"><span>5</span><div class="bg-green-500 h-2 rounded w-1/2"></div><span>25</span></div>
                    <div class="flex items-center gap-2"><span>4</span><div class="bg-green-500 h-2 rounded w-1/3"></div><span>9</span></div>
                </div>
            </div>
    </div>

    <script>
        function selectVariant(variant) {
            document.getElementById('selectedVariant').value = variant;
            document.querySelectorAll('.variant-btn').forEach(btn => {
                btn.classList.remove('bg-green-500', 'text-white');
            });
            event.target.classList.add('bg-green-500', 'text-white');
        }
    </script>
    <script>
        document.getElementById('decreaseQty').addEventListener('click', function() {
            let qtyInput = document.getElementById('quantityInput');
            let current = parseInt(qtyInput.value);
            if (current > 1) qtyInput.value = current - 1;
        });
    
        document.getElementById('increaseQty').addEventListener('click', function() {
            let qtyInput = document.getElementById('quantityInput');
            let max = parseInt(qtyInput.max);
            let current = parseInt(qtyInput.value);
            if (current < max) qtyInput.value = current + 1;
        });
    </script>
    
</x-app-layout>
