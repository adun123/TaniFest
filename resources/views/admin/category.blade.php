<x-admin-layout>
<div class="max-w-5xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Kelola Kategori Banner</h1>

    <!-- Form Tambah -->
    <form action="{{ route('category-banners.store') }}" method="POST" enctype="multipart/form-data" class="mb-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label for="title" class="block text-sm font-medium">Judul Kategori</label>
                <input type="text" name="title" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
                <label for="image" class="block text-sm font-medium">Gambar</label>
                <input type="file" name="image" class="w-full">
            </div>
            <div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah</button>
            </div>
        </div>
    </form>

    <!-- Daftar Kategori -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($categories as $category)
            <div class="bg-white shadow rounded p-3 text-center">
                @if ($category->image_url)
                    <img src="{{ asset('storage/' . $category->image_url) }}" alt="{{ $category->title }}" class="w-full h-32 object-cover mb-2 rounded">
                @endif
                <p class="font-semibold">{{ $category->title }}</p>

                <!-- Edit & Hapus -->
                <form action="{{ route('category-banners.destroy', $category) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus kategori ini?')" class="text-red-500 hover:underline text-sm">Hapus</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
</x-admin-layout>