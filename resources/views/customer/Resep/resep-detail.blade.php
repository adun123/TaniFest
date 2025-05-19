<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Judul -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Resep</h1>
            <p class="text-xl">{{ $resep->nama }}</p>
        </div>

        <!-- Video dan Container Kanan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Video / Foto -->
            <div class="md:col-span-2 relative">
                @if ($resep->video)
                    <iframe class="w-full h-64 md:h-96 rounded-lg" src="{{ $resep->video }}" frameborder="0" allowfullscreen></iframe>
                @elseif ($resep->foto)
                    <img src="{{ asset('storage/' . $resep->foto) }}" alt="{{ $resep->nama }}" class="rounded-lg w-full">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                        <span class="text-gray-500">No Media</span>
                    </div>
                @endif
            </div>

            <!-- Info Resep -->
            <div class="border rounded-lg p-4 shadow">
                <h2 class="text-lg font-semibold mb-4">Detail Resep</h2>
                <p class="text-gray-700 mb-2">{{ $resep->deskripsi }}</p>
                <p class="text-green-600 font-bold mb-4">Rp {{ number_format($resep->harga) }}</p>
                <button class="bg-green-600 text-white w-full py-2 rounded hover:bg-green-700 transition">Tambahkan ke keranjang</button>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
            <p class="text-gray-700">{{ $resep->deskripsi }}</p>
        </div>

        <!-- Dummy Ulasan -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Ulasan</h2>
            <div class="space-y-4">
                <div class="p-4 border rounded-lg shadow">
                    <p class="font-semibold">Andi</p>
                    <p class="text-gray-600">Rasanya autentik banget! Bumbu sangat terasa.</p>
                </div>
                <div class="p-4 border rounded-lg shadow">
                    <p class="font-semibold">Rina</p>
                    <p class="text-gray-600">Mudah diikuti dan hasilnya enak. Recommended!</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
