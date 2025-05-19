<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   
    <div 
        x-data="{
            slides: [
                {
                    image: '{{ asset('images/sayur.png') }}',
                    title: 'Fresh Berkualitas',
                    description: 'Tanifest memastikan kualitas produk untuk Anda'
                },
                {
                    image: '{{ asset('images/banner1.svg') }}',
                    title: 'Pedas Nikmat',
                    description: 'Cabai segar langsung dari petani hanya di Tanifest'
                },
                {
                    image: '{{ asset('images/banner2.svg') }}',
                    title: 'Bawang Pilihan',
                    description: 'Bawang merah & putih kualitas terbaik untuk dapur Anda'
                }
            ],
            activeSlide: 0
        }"
        x-init="setInterval(() => activeSlide = (activeSlide + 1) % slides.length, 5000)"
        class="relative w-full max-w-6xl mx-auto mt-6 h-[400px] overflow-hidden rounded-xl"
    >

        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div 
                x-show="activeSlide === index"
                x-transition
                class="absolute inset-0 w-full h-full"
            >
                <img 
                    :src="slide.image" 
                    class="object-cover w-full h-full"
                >


                <!-- Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-center">
                    {{-- <div x-show="index === 0">
                        <h1 class="text-4xl font-bold md:text-6xl">Fresh Berkualitas</h1>
                        <p class="mt-4 text-xl md:text-2xl">Tanifest memastikan <br> kualitas produk <br> untuk Anda</p>
                    </div>
                    <div x-show="index === 1">
                        <h1 class="text-4xl font-bold md:text-6xl">Pedas Nikmat</h1>
                        <p class="mt-4 text-xl md:text-2xl">Cabai segar langsung dari petani <br> hanya di Tanifest</p>
                    </div>
                    <div x-show="index === 2">
                        <h1 class="text-4xl font-bold md:text-6xl">Bawang Pilihan</h1>
                        <p class="mt-4 text-xl md:text-2xl">Bawang merah & putih kualitas terbaik <br> untuk dapur Anda</p>
                    </div> --}}
                </div>
            </div>
        </template>

        <!-- Dot Navigation -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button 
                    @click="activeSlide = index"
                    class="w-3 h-3 rounded-full bg-black"
                    :class="{ 'bg-white': activeSlide === index }"
                ></button>
            </template>
        </div>
    </div>

    <!-- Section Title bagian diskon -->
<div class="flex justify-between items-center px-6 mt-10">
    <h2 class="text-2xl font-semibold text-gray-800">Diskon Special</h2>
    <a href="#" class="text-green-600 hover:underline">Lihat lainnya</a>
</div>

{{-- <!-- Product Cards -->
<div class="flex flex-wrap gap-4 px-6 mt-6">
    @for ($i = 0; $i < 4; $i++)
        <div class="w-[22%] bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Product Image -->
            <div class="h-40 overflow-hidden">
                <img src="{{ asset('images/sayur.png') }}" alt="Product" class="w-full h-full object-cover">
            </div>

            <!-- Product Info -->
            <div class="p-4">
                <h3 class="font-semibold text-lg mb-1">Produk Diskon {{ $i + 1 }}</h3>
                <p class="text-sm text-gray-500 mb-2">Kategori</p>
                <p class="text-green-600 font-bold mb-1">Rp 10.000 <span class="text-gray-400 line-through text-sm ml-2">Rp 15.000</span></p>
                <p class="text-sm text-gray-500">Stok: 20 tersedia</p>
            </div>
        </div>
    @endfor
</div> --}}
<!-- Kategori Pilihan -->
<div class="flex justify-between items-center px-6 mt-10">
    <h2 class="text-2xl font-semibold text-gray-800">Kategori Pilihan</h2>
    <a href="#" class="text-green-600 hover:underline">Lihat lainnya</a>
</div>

<div class="flex flex-wrap gap-4 px-6 mt-4">
    @php
        $kategori = [
            ['name' => 'Sayuran', 'image' => 'images/sayur.png'],
            ['name' => 'Buah Buahan', 'image' => 'images/kategori/buah.jpg'],
            ['name' => 'Rempah-Rempah', 'image' => 'images/kategori/rempah.jpg'],
            ['name' => 'Daging', 'image' => 'images/kategori/daging.jpg'],
        ];
    @endphp

    @foreach ($kategori as $item)
        <div class="relative w-[22%] h-32 rounded-lg overflow-hidden shadow-md">
            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="object-cover w-full h-full">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <span class="text-white text-lg font-semibold">{{ $item['name'] }}</span>
            </div>
        </div>
    @endforeach
</div>

<!-- Inspirasi Untuk Kamu -->
<div class="flex justify-between items-center px-6 mt-10">
    <h2 class="text-2xl font-semibold text-gray-800">Inspirasi Untuk Kamu</h2>
    <a href="#" class="text-green-600 hover:underline">Cek resep lainnya</a>
</div>

<div class="flex flex-wrap gap-4 px-6 mt-4">
    @forelse ($reseps as $resep)
        <div class="relative w-[15%] h-40 rounded-lg overflow-hidden shadow-md">
            <img src="{{ asset('storage/' . $resep->foto) }}" alt="{{ $resep->nama }}" class="object-cover w-full h-full">
            <div class="absolute inset-0 bg-black bg-opacity-10 flex items-center justify-center text-center px-1">
                <span class="text-white text-sm font-semibold">{{ $resep->nama }}</span>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Belum ada resep tersedia.</p>
    @endforelse
</div>




</x-app-layout>
