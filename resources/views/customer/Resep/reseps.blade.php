@php
    $kategoriAktif = request('kategori'); // Jika kategori diterapkan
@endphp

<x-app-layout>
    

    <!-- Grid Resep -->
    <section class="resep">
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-7">Resep Populer</h2>
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
                                <a href="{{ route('customer.reseps.show', $resep->id) }}" class=" hover:underline">
                                    {{ $resep->nama }}
                                </a>
                            </h3>
                        </div>
                    </div>
                @empty
                    <div class="col-span-5 text-center py-10">
                        <p class="text-gray-500">Tidak ada resep yang tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Grid Resep -->
    <section class="resep">
        <div class="container mx-auto px-4 justify-center py-8">
            <h2 class="text-2xl font-semibold text-gray-800 text-center mb-2">Terbaru Dirilis </h2>
            <h4 class="text-2xl  font-bold text-center mb-8">Resep Terkini Sesuai <span class="text-green-600 font-bold">Minatmu</span>.</h4>
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
                        </div>
                    </div>
                @empty
                    <div class="col-span-5 text-center py-10">
                        <p class="text-gray-500">Tidak ada resep yang tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    
</x-app-layout>
