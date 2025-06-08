<x-app-layout>

    {{-- Banner --}}
    <section>
        <div class="mb-5 py-7 px-7">
             <img src="{{ asset('img/kategori.svg') }}" alt="Banner" class="w-full h-auto rounded-lg" />
        </div>
    </section>
 
    <!-- Kategori Pilihan -->
        <div class="max-w-7xl mx-auto py-10 px-4">
            
            <section class="mb-10">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Kategori Pilihan</h2>
                    
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4">
                    @foreach ($categories->unique('title') as $category)
                        <a href="{{ route('customer.category') }}" class="relative block rounded-xl overflow-hidden shadow hover:shadow-lg transition group">
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
    <section>

    </section>
</x-app-layout>