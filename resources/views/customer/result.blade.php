<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-6">Hasil Pencarian: "{{ $q }}"</h2>

        <!-- Produk -->
        <div class="mb-10">
            <h3 class="text-lg font-bold mb-4">Produk</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                @forelse($products as $product)
                    <div class="bg-white border rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
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
                        <div class="p-2">
                            <h3 class="font-semibold text-lg mb-1 truncate">
                                <a href="{{ route('customer.product.show', $product->id) }}" class="hover:underline">
                                    {{ $product->nama }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 text-sm mb-2">{{ $product->variants ?? '1 pack' }}</p>
                            
                            <div class="flex justify-between items-center mt-3">
                                <div>
                                    <p class="text-green-600 font-bold">Rp {{ number_format($product->harga) }}</p>
                                    <p class="text-sm text-gray-500">
                                        Stok: <span class="{{ $product->jumlah > 0 ? 'text-green-500' : 'text-red-500' }}">
                                            {{ $product->jumlah > 0 ? $product->jumlah.' tersedia' : 'Habis' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-6 text-center py-10">
                        <p class="text-gray-500">Tidak ada produk ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Resep -->
        <div>
            <h3 class="text-lg font-bold mb-4">Resep</h3>
            @forelse ($reseps as $resep)
                <div class="mb-4 p-4 border rounded-md shadow hover:shadow-md transition">
                    <p class="font-semibold text-lg">{{ $resep->nama }}</p>
                    <p class="text-sm text-gray-600 mb-2">{{ \Illuminate\Support\Str::limit($resep->deskripsi, 100) }}</p>
                    <a href="{{ route('customer.resep.show', $resep->id) }}" class="text-green-600 text-sm hover:underline">Lihat Resep</a>
                </div>
            @empty
                <p class="text-gray-500">Tidak ada resep ditemukan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
