<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Manajemen Produk') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        {{-- Form Tambah Produk --}}
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label class="block font-bold">Nama Produk</label>
                <input type="text" name="nama" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Jumlah</label>
                <input type="number" name="jumlah" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Harga</label>
                <input type="number" name="harga" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Kategori</label>
                <select name="category" class="w-full border rounded p-2" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Sayuran Hijau">Sayuran Hijau</option>
                    <option value="Bawang">Bawang</option>
                    <option value="Cabai">Cabai</option>
                    <option value="Rempah">Rempah</option>
                    <option value="Daging">Daging</option>
                    <option value="Buah">Buah</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Foto Produk</label>
                <input type="file" name="photo" class="w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block font-bold">Deskripsi</label>
                <textarea name="description" class="w-full border rounded p-2" rows="4"></textarea>
            </div>
            
            <div class="mb-4">
                <label class="block font-bold">Varian (pisahkan dengan koma, contoh: 400gr,800gr,1kg)</label>
                <input type="text" name="variants" class="w-full border rounded p-2">
            </div>
            
            <div class="mb-4">
                <label class="block font-bold">Foto Lain (bisa pilih lebih dari 1)</label>
                <input type="file" name="photos[]" multiple class="w-full border rounded p-2">
            </div>
            
            <button class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Produk</button>
        </form>


        {{-- Tabel Produk --}}
        <div class="mt-10 bg-white shadow rounded p-6">
            <h3 class="text-lg font-bold mb-4">Daftar Produk</h3>
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Jumlah</th>
                        <th class="border px-4 py-2">Harga</th>
                        
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Foto</th>
                        
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $product->nama }}</td>
                            <td class="border px-4 py-2">{{ $product->jumlah }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($product->harga) }}</td>
                            <td class="border px-4 py-2">{{ $product->category }}</td>
                            <td class="border px-4 py-2">
                                @if($product->photo)
                                    <img src="{{ asset('storage/'.$product->photo) }}" width="50">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center p-4">Belum ada produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
