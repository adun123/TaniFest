<x-app-layout>
    
    
    <div class="container mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- KIRI: Gambar & Deskripsi -->
       
        <div>
            <!-- Foto Utama -->
            <div class="w-full h-[500px] rounded-lg shadow overflow-hidden border">
                @if($product->photo)
                    <img src="{{ asset('storage/'.$product->photo) }}" class="w-full h-full object-contain">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                        <span>No Image</span>
                    </div>
                @endif
            </div>

            <!-- Foto Tambahan -->
            @if($product->photos)
                <div class="flex gap-4 mt-6">
                    @foreach(json_decode($product->photos, true) as $photo)
                        <div class="w-[100px] h-[100px] border rounded-lg overflow-hidden shadow hover:scale-105 transition duration-300">
                            <img src="{{ asset('storage/'.$photo) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif
            {{-- garis --}}
            <hr class="my-6 border-t-2 border-gray-400">
            <!-- Info Penjual & WhatsApp -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <!-- Foto Penjual Dummy -->
                <img src="https://randomuser.me/api/portraits/women/45.jpg" 
                     alt="Penjual" 
                     class="w-12 h-12 rounded-full object-cover border-2 border-green-500">
                
                <div class="ml-3">
                    <p class="font-semibold text-gray-800">Toko Sehat Alami</p>
                    <p class="text-sm text-gray-500">Aktif 1 jam yang lalu</p>
                </div>
            </div>
            
            <!-- Tombol WhatsApp -->
            <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20produk%20{{ urlencode($product->nama) }}%20di%20toko%20Anda" 
               target="_blank"
               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full flex items-center transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Hubungi Penjual
            </a>
        </div>
    </div>

            <!-- Detail -->
            <div class="mb-6 mt-5">
                <h3 class="text-lg font-bold mb-2">Detail</h3>
                <p class="mb-4">{{ $product->description }}</p>
            </div>

            <hr class="my-6 border-t-2 border-gray-400">
             <!-- Ulasan -->
            
        </div>
        
         <!-- KANAN: Info & Aksi -->
        <!-- Info Produk -->
        <div>
            <h1 class="text-7xl font- mb-2">{{ $product->nama }}</h1>
            <p class="text-gray-600 mb-4">{{ $product->category }}</p>
            <div class="flex items-center justify-between gap-2 mb-4">
                <div class="flex text-yellow-400">
                    @for ($i = 0; $i < 4; $i++)
                        ★
                    @endfor
                    ☆
                </div>
                <div>
                    <span class="text-md text-green-600">Ulasan </span>
                <span class="text-md text-gray-600">(1440) </span>
                </div>
                
            </div>
            <p class="text-black-600 text-3xl font-bold mb-4">Rp {{ number_format($product->harga) }}</p>
            <hr class="my-6 border-t-2 border-gray-400">
            {{-- <p class="mb-4">{{ $product->description }}</p> --}}

            @if(!empty($product->variants))
    @php
        $variants = json_decode($product->variants, true);
    @endphp

    @if(is_array($variants))
        <label class="block mt-10 font-semibold mb-2">Pilih Varian dan Catatan:</label>
        <div class="flex gap-2 mb-4">
            @foreach($variants as $variant)
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
                <h3 class="text-lg font-bold mb-4 text-green-600">Produk Serupa</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-2 gap-2">
                    @foreach ($relatedProducts as $related)
                        <div class="border rounded-lg p-3  hover:shadow-lg transition duration-300 bg-white">
                        <img src="{{ asset('storage/' . $related->photo) }}"
                            alt="{{ $related->nama }}"
                            class="w-full h-32 sm:h-36 md:h-40 object-cover object-center rounded mb-2">
                            <p class="text-sm font-semibold truncate">{{ $related->nama }}</p>
                            <p class="text-sm text-gray-700">Rp {{ number_format($related->harga) }}</p>
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
                    <div class="flex items-center gap-2"><span>4</span><div class="bg-green-500 h-2 rounded w-1/2"></div><span>9</span></div>
                </div>
                <div class="space-y-1 text-sm text-gray-600">
                    <div class="flex items-center gap-2"><span>3</span><div class="bg-green-500 h-2 rounded w-1/3"></div><span>4</span></div>
                    <div class="flex items-center gap-2"><span>2</span><div class="bg-green-500 h-2 rounded w-1/5"></div><span>1</span></div>
                </div>
                <div class="space-y-1 text-sm text-gray-600">
                    <div class="flex items-center gap-2"><span>1</span><div class="bg-green-500 h-2 rounded w-1/5"></div><span>1</span></div>
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
