<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Manajemen Resep') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        {{-- Form Tambah Resep --}}
        <form action="{{ route('admin.reseps.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label class="block font-bold">Nama Resep</label>
                <input type="text" name="nama" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border rounded p-2" rows="4"></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Harga</label>
                <input type="number" name="harga" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Stok</label>
                <input type="number" name="stok" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Bahan-bahan</label>
                <div id="bahan-list">
                    <input type="text" name="bahan[]" class="w-full border rounded p-2 mb-2" placeholder="Contoh: 2 butir telur" required>
                </div>
                <button type="button" onclick="tambahBahan()" class="text-blue-500 mt-2">+ Tambah Bahan</button>
            </div>




            <div class="mb-4">
                <label class="block font-bold">Foto Resep</label>
                <input type="file" name="foto" class="w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block font-bold">Link Video (YouTube)</label>
                <input type="url" name="video" class="w-full border rounded p-2" placeholder="https://youtube.com/...">
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Resep</button>
        </form>

        {{-- Tabel Resep --}}
        <div class="mt-10 bg-white shadow rounded p-6">
            <h3 class="text-lg font-bold mb-4">Daftar Resep</h3>
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Foto</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reseps as $resep)
                        <tr>
                            <td class="border px-4 py-2">{{ $resep->nama }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($resep->harga) }}</td>
                            <td class="border px-4 py-2">
                                @if($resep->foto)
                                    <img src="{{ asset('storage/'.$resep->foto) }}" width="50">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.reseps.destroy', $resep) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center p-4">Belum ada resep.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function tambahBahan() {
            const container = document.getElementById('bahan-list');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'bahan[]';
            input.className = 'w-full border rounded p-2 mb-2';
            input.placeholder = 'Contoh: 200gr tepung';
            container.appendChild(input);
        }
    </script>
</x-admin-layout>
