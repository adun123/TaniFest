@php
    $kategoriAktif = request('kategori'); // Ambil kategori dari URL jika ada
@endphp

<x-app-layout>


     {{-- Banner --}}
    <section>
        <div class="mb-5 py-7 px-7">
             <img src="{{ asset('img/listsemua.svg') }}" alt="Banner" class="w-full h-auto rounded-lg" />
        </div>
    </section>

    <!-- Kategori Filter -->
     <div class="mt-6 px-6 flex flex-wrap gap-3">
            @foreach (['semua' => 'Semua', 'Sayuran Hijau' => 'Sayuran Hijau', 'cabai' => 'Cabai', 'Bawang' => 'Bawang', 'rempah' => 'Rempah','Daging'=>'Daging', 'lainnya' => 'Lainnya'] as $key => $label)
                <a href="{{ route('customer.category', ['kategori' => $key]) }}"
                    class="flex-1 text-sm px-4 py-3 rounded-lg border transition text-center
                    {{ $kategoriAktif == $key ? 'bg-green-500 text-white border-green-500' : 'bg-white text-gray-700 hover:bg-green-100 border-gray-300' }}">
                    {{ $label }}
                </a>
            @endforeach
    </div>

    <!-- Produk Card Grid -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Product Image -->
                    <div class="h-48 overflow-hidden">
                        @if($product->photo)
                            <img src="{{ asset('storage/'.$product->photo) }}" alt="{{ $product->nama }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1 truncate">
                            <a href="{{ route('product.detail', $product) }}" class="hover:underline">
                                {{ $product->nama }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-2">{{ $product->category }}</p>
                        
                        <div class="flex justify-between items-center mt-3">
                            <div>
                                <p class="text-green-600 font-bold">Rp {{ number_format($product->harga) }}</p>
                                <p class="text-sm text-gray-500">
                                    Stok: <span class="{{ $product->jumlah > 0 ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $product->jumlah > 0 ? $product->jumlah.' tersedia' : 'Habis' }}
                                    </span>
                                </p>
                            </div>
                            {{-- <form action="{{ route('cart.store', $product) }}" method="POST">
                                @csrf
                                <div class="flex items-center gap-2">
                                    <input type="number" 
                                           name="quantity" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $product->jumlah }}"
                                           class="w-16 text-center border rounded">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-full transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-6 text-center py-10">
                    <p class="text-gray-500">Tidak ada produk yang tersedia</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>