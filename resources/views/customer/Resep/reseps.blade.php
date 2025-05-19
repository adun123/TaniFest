@php
    $kategoriAktif = request('kategori'); // Jika kategori diterapkan
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Kumpulan Resep') }}
        </h2>
    </x-slot>

    <!-- Banner -->
    <div class="relative w-full h-96 px-4 py-8 sm:px-6 lg:px-8">
        <div class="absolute inset-0 rounded-xl overflow-hidden">
            <img 
                src="{{ asset('images/banner-resep.jpg') }}" 
                alt="Banner Resep" 
                class="object-cover w-full h-full"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>

        <div class="relative z-10 flex items-center justify-center w-full h-full text-center text-white">
            <div>
                <h1 class="text-4xl font-bold md:text-5xl">Inspirasi Masakan Lezat</h1>
                <p class="mt-4 text-lg md:text-2xl leading-relaxed">
                    Temukan berbagai resep untuk hidangan istimewa keluarga Anda
                </p>
            </div>
        </div>
    </div>

    <!-- Filter kategori resep (opsional jika ada kategorinya) -->
    {{-- 
    <div class="mt-6 px-6 flex flex-wrap gap-2 justify-center">
        @foreach (['semua' => 'Semua', 'Masakan Nusantara', 'Dessert', 'Minuman'] as $key => $label)
            <a 
                href="{{ route('customer.reseps', ['kategori' => $key]) }}" 
                class="px-4 py-2 rounded-full border transition 
                       {{ $kategoriAktif == $key ? 'bg-green-500 text-white' : 'bg-white text-gray-700 hover:bg-green-100' }}"
            >
                {{ $label }}
            </a>
        @endforeach
    </div>
    --}}

    <!-- Grid Resep -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @forelse($reseps as $resep)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Foto Resep -->
                    <div class="h-40 overflow-hidden">
                        @if($resep->foto)
                            <img src="{{ asset('storage/'.$resep->foto) }}" alt="{{ $resep->nama }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                    </div>

                    <!-- Info Resep -->
                    <div class="p-4">
                        <h3 class="font-semibold text-base mb-1 truncate">
                            <a href="{{ route('customer.reseps.show', $resep->id) }}" class="text-green-700 hover:underline">
                                {{ $resep->nama }}
                            </a>
                        </h3>
                        
                        <p class="text-sm text-gray-600 truncate mb-2">{{ Str::limit($resep->deskripsi, 50) }}</p>

                        <div class="mt-2">
                            <p class="text-green-600 font-bold">Rp {{ number_format($resep->harga) }}</p>
                        </div>

                        @if ($resep->video)
                            <div class="mt-2">
                                <a href="{{ $resep->video }}" target="_blank" class="text-blue-500 text-sm hover:underline">
                                    Lihat Video
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-5 text-center py-10">
                    <p class="text-gray-500">Tidak ada resep yang tersedia</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
