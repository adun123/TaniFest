@php
    $kategoriAktif = request('kategori'); // Ambil kategori dari URL jika ada
@endphp
<x-app-layout>


   
    <!-- Banner -->
    <section class="banner mx-5 mt-4">
        <div
            id="hero"
            class="carousel slide"
            data-bs-ride="true"
            data-bs-theme="dark">
            <div class="carousel-inner justify-content-center">
                <div class="carousel-item active">
                    <img src="{{ asset('images/banner1.svg') }}" class="w-100 rounded" alt="" />
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner2.svg') }}" class="w-100 rounded" alt="" />
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner1.svg') }}" class="w-100 rounded" alt="" />
                </div>
            </div>
            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#hero"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#hero"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <div class="carousel-dark">
                <div class="carousel-indicators">
                    <button
                        type="button"
                        data-bs-target="#hero"
                        data-bs-slide-to="0"
                        class="active"
                        aria-current="true"
                        aria-label="Slide 1"></button>
                    <button
                        type="button"
                        data-bs-target="#hero"
                        data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button
                        type="button"
                        data-bs-target="#hero"
                        data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
            </div>
        </div>
    </section>


        <!-- Section Title bagian diskon -->
        <div class="flex justify-between items-center px-6 mt-10">
            <h2 class="text-2xl font-semibold text-gray-800">Diskon Spesial</h2>
            <a href="#" class="text-green-600 hover:underline">Lihat lainnya</a>
        </div>

        <!-- Countdown -->
        <div class="px-6 mt-2 mb-4 text-sm text-gray-600">
            Berakhir pada 
            <span class="bg-red-500 text-white px-2 py-1 rounded">03</span> :
            <span class="bg-red-500 text-white px-2 py-1 rounded">18</span> :
            <span class="bg-red-500 text-white px-2 py-1 rounded">59</span>
        </div>

        <!-- Produk Grid -->
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
                @foreach ($discountedProducts as $product)
                    <div class="bg-white rounded shadow-sm hover:shadow-md transition-all p-3">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->nama }}"
                            class="w-full h-32 object-cover rounded">
                        <div class="mt-2 text-sm text-gray-700 font-semibold truncate">{{ $product->nama }}</div>
                        <div class="text-xs text-gray-500">
                            {{ $product->variants ?? '1 pack' }}
                        </div>
                        <div class="mt-1 font-bold text-sm text-black">
                            Rp. {{ number_format($product->harga, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>





    <!-- Kategori Pilihan -->
        <div class="max-w-7xl mx-auto py-4 px-4">
            
            <section class="mb-10">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Kategori Pilihan</h2>
                    <a href="{{ route('customer.category.semua') }}" class="text-green-600 hover:underline">Lihat lainnya</a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4">
                    @foreach ($categories->unique('title')->take(4) as $category)
                        <a href="#" class="relative block rounded-xl overflow-hidden shadow hover:shadow-lg transition group">
                            <img src="{{ asset('storage/' . $category->image_url) }}" alt="{{ $category->title }}"
                                class="w-full h-40 object-cover group-hover:scale-105 transition duration-300">

                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                <h5 class="text-white text-lg font-bold drop-shadow">{{ $category->title }}</h5>
                            </div>
                        </a>
                    @endforeach

                </div>
            </section>
        </div>


    <!-- Inspirasi Untuk Kamu -->
    <div class="flex justify-between items-center px-6 ">
        <h2 class="text-2xl font-semibold text-gray-800">Inspirasi Untuk Kamu</h2>
        <a href="{{ route('customer.reseps.index')}}" class="text-green-600 hover:underline">Cek resep lainnya</a>
    </div>

    <div class="flex flex-wrap gap-4 px-6 mt-4">
        @forelse ($reseps->take(7) as $resep)
            <div class="relative w-[15%] h-full rounded-lg overflow-hidden shadow-md">
                <img src="{{ asset('storage/' . $resep->foto) }}" alt="{{ $resep->nama }}" class="object-cover w-full h-full">
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center text-center px-1">
                    <span class="text-white text-sm font-semibold">{{ $resep->nama }}</span>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada resep tersedia.</p>
        @endforelse
    </div>


    <section>
            <div class="flex justify-between items-center px-6 mt-10">
                <h2 class="text-2xl font-semibold text-gray-800">Produk Terbaik Hari ini</h2>
            </div>
            <!-- Kategori Filter -->
            <div class="mt-6 px-6 flex flex-wrap gap-3">
                @foreach (['semua' => 'Semua', 'Sayuran Hijau' => 'Sayuran Hijau', 'cabai' => 'Cabai', 'Bawang' => 'Bawang', 'rempah' => 'Rempah', 'lainnya' => 'Lainnya'] as $key => $label)
                    <a href="{{ route('customer.dashboard', ['kategori' => $key]) }}"
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
                                    <a href="{{ route('product.detail', $product) }}" class="hover:underline">
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
                            <p class="text-gray-500">Tidak ada produk yang tersedia</p>
                        </div>
                    @endforelse
                </div>
            </div>
    </section>




</x-app-layout>
