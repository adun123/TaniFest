<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Judul -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Resep</h1>
            <p class="text-xl font-bold">{{ $resep->nama }}</p>
        </div>

        <!-- Video dan Container Kanan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Video / Foto -->
            <div class="md:col-span-2 relative">
                @if ($resep->video)
                    <iframe class="w-full h-64 md:h-96 rounded-lg"
                            src="https://www.youtube.com/embed/{{ $resep->video }}"
                            frameborder="0"
                            allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                    </iframe>
                

                @elseif ($resep->foto)
                    <img src="{{ asset('storage/' . $resep->foto) }}" alt="{{ $resep->nama }}" class="rounded-lg w-full">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                        <span class="text-gray-500">No Media</span>
                    </div>
                @endif

            </div>

            <!-- Info Resep yang Mirip Gambar -->
            <div class="border rounded-lg py-9 justify-between p-4 shadow">
                <!-- Judul -->
                <h2 class="text-lg font-semibold mb-4">Bahan dalam resep ini</h2>

                <!-- Box Produk -->
                <div class="border rounded-xl p-3 flex items-center space-x-4 mb-6">
                    <!-- Foto Produk -->
                    <div class="w-20 h-20 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100">
                        @if ($resep->foto)
                            <img src="{{ asset('storage/' . $resep->foto) }}" alt="{{ $resep->nama }}" class="object-cover w-full h-full">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                    </div>

                    <!-- Detail -->
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">{{ $resep->nama }}</p>
                        <p class="text-sm text-gray-400">1 buah</p>
                        <p class="text-base text-gray-800 font-bold mt-1">Rp {{ number_format($resep->harga) }}</p>
                    </div>
                </div>

                <!-- Tombol -->
                <form action="{{ route('cart.resep.store', $resep) }}" method="POST">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" class="hidden" />

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg transition duration-200">
                        Tambahkan ke keranjang
                    </button>
                </form>

            </div>

        </div>
        <!-- Deskripsi -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
            <p class="text-gray-700">{{ $resep->deskripsi }}</p>
        </div>

        <!-- Bahan-bahan -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-2">Bahan-bahan</h2>
            <ul class="list-disc list-inside text-gray-700">
                @forelse ($resep->bahans as $bahan)
                    <li>{{ $bahan->nama }}</li>
                @empty
                    <li>Tidak ada bahan tersedia untuk resep ini.</li>
                @endforelse
            </ul>
        </div>


        
    </div>
</x-app-layout>
