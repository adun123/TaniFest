<x-admin-layout>
    <x-slot name="header">
        {{ __('Produk & Persediaan') }}
    </x-slot>

    <div class="space-y-8">
        <section class="overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-950 via-emerald-900 to-slate-900 p-6 text-white shadow-2xl shadow-emerald-950/20 sm:p-8">
            <div class="grid gap-6 lg:grid-cols-5 lg:items-end">
                <div class="lg:col-span-3">
                    <p class="text-sm font-bold uppercase tracking-widest text-emerald-200">Inventori TaniFest</p>
                    <h2 class="mt-3 max-w-3xl text-3xl font-black tracking-tight sm:text-4xl">Kelola produk segar dengan ruang kerja yang rapi dan cepat.</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-emerald-50/80">Tambah stok, atur kategori, unggah foto, dan pantau diskon produk tanpa mengubah alur backend yang sudah berjalan.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur lg:col-span-2">
                    <p class="text-sm font-semibold text-emerald-100">Total produk tampil</p>
                    <p class="mt-2 text-4xl font-black">{{ count($products) }}</p>
                    <p class="mt-2 text-xs text-emerald-100/80">Data mengikuti koleksi produk yang dikirim controller.</p>
                </div>
            </div>
        </section>

        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-900 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-800 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800 shadow-sm">
                <p class="font-black">Produk belum bisa disimpan.</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="grid gap-8 xl:grid-cols-5">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="rounded-3xl border border-emerald-100 bg-white p-5 shadow-xl shadow-emerald-950/5 sm:p-6 xl:col-span-2">
                @csrf
                <div class="mb-6 flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Tambah produk</p>
                        <h3 class="mt-2 text-2xl font-black text-slate-950">Form panen baru</h3>
                    </div>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-800">Produk</span>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-slate-700">Nama Produk</label>
                        <input type="text" name="nama" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" value="{{ old('nama') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Jumlah</label>
                        <input type="number" name="jumlah" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" value="{{ old('jumlah') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Harga</label>
                        <input type="number" name="harga" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" value="{{ old('harga') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Kategori</label>
                        <select name="category" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Sayuran Hijau" @selected(old('category') === 'Sayuran Hijau')>Sayuran Hijau</option>
                            <option value="Bawang" @selected(old('category') === 'Bawang')>Bawang</option>
                            <option value="Cabai" @selected(old('category') === 'Cabai')>Cabai</option>
                            <option value="Rempah" @selected(old('category') === 'Rempah')>Rempah</option>
                            <option value="Daging" @selected(old('category') === 'Daging')>Daging</option>
                            <option value="Buah" @selected(old('category') === 'Buah')>Buah</option>
                            <option value="Lainnya" @selected(old('category') === 'Lainnya')>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label for="discount_percentage" class="block text-sm font-bold text-slate-700">Diskon (%)</label>
                        <input type="number" name="discount_percentage" id="discount_percentage" min="0" max="100" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" value="{{ old('discount_percentage', 0) }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-slate-700">Deskripsi</label>
                        <textarea name="description" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-slate-700">Varian</label>
                        <input type="text" name="variants" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" value="{{ old('variants') }}" placeholder="400gr,800gr,1kg">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Foto Produk</label>
                        <input type="file" name="photo" class="mt-2 w-full rounded-2xl border border-dashed border-emerald-200 bg-emerald-50/60 px-4 py-3 text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-800 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-emerald-900">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Foto Lain</label>
                        <input type="file" name="photos[]" multiple class="mt-2 w-full rounded-2xl border border-dashed border-emerald-200 bg-emerald-50/60 px-4 py-3 text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-800 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-emerald-900">
                    </div>
                </div>

                <button class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-emerald-800 px-5 py-3 text-sm font-black text-white shadow-lg shadow-emerald-900/20 transition hover:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    Simpan Produk
                </button>
            </form>

            <div class="min-w-0 rounded-3xl border border-slate-100 bg-white p-5 shadow-xl shadow-emerald-950/5 sm:p-6 xl:col-span-3">
                <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Katalog aktif</p>
                        <h3 class="mt-2 text-2xl font-black text-slate-950">Daftar Produk</h3>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Geser tabel di layar kecil untuk melihat semua aksi.</p>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-slate-100">
                    <table class="min-w-full divide-y divide-slate-100 text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-4 py-3 font-black">Nama</th>
                                <th class="px-4 py-3 font-black">Jumlah</th>
                                <th class="px-4 py-3 font-black">Harga</th>
                                <th class="px-4 py-3 font-black">Diskon</th>
                                <th class="px-4 py-3 font-black">Kategori</th>
                                <th class="px-4 py-3 font-black">Foto</th>
                                <th class="px-4 py-3 font-black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($products as $product)
                                <tr class="transition hover:bg-emerald-50/40">
                                    <td class="px-4 py-4 font-bold text-slate-900">{{ $product->nama }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $product->jumlah }}</td>
                                    <td class="px-4 py-4 font-semibold text-slate-900">Rp {{ number_format($product->harga) }}</td>
                                    <td class="px-4 py-4">
                                        @if($product->discount_percentage > 0)
                                            <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-black text-amber-800">{{ $product->discount_percentage }}%</span>
                                        @else
                                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-black text-emerald-800">{{ $product->category }}</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        @if($product->photo)
                                            <img src="{{ asset('storage/'.$product->photo) }}" alt="{{ $product->nama }}" class="h-14 w-14 rounded-2xl object-cover ring-1 ring-slate-100">
                                        @else
                                            <span class="grid h-14 w-14 place-items-center rounded-2xl bg-emerald-50 text-xs font-black text-emerald-700 ring-1 ring-emerald-100">TF</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <button class="rounded-xl bg-slate-900 px-3 py-2 text-xs font-black text-white transition hover:bg-emerald-900" onclick="openEditModal({{ $product->id }})">
                                                Edit
                                            </button>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                                @csrf @method('DELETE')
                                                <button class="rounded-xl bg-red-50 px-3 py-2 text-xs font-black text-red-700 transition hover:bg-red-100">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-10 text-center text-slate-500">Belum ada produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-slate-950/60 p-4 backdrop-blur-sm">
            <div class="relative w-full max-w-3xl rounded-3xl bg-white p-5 shadow-2xl shadow-slate-950/20 sm:p-6">
                <div class="mb-5 pr-10">
                    <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Edit produk</p>
                    <h2 class="mt-2 text-2xl font-black text-slate-950">Perbarui detail produk</h2>
                </div>
                <form id="editProductForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editProductId" name="id">

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-slate-700">Nama</label>
                            <input type="text" name="nama" id="editNama" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700">Jumlah</label>
                            <input type="number" name="jumlah" id="editJumlah" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700">Harga</label>
                            <input type="number" name="harga" id="editHarga" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700">Diskon (%)</label>
                            <input type="number" name="discount_percentage" id="editDiskon" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700">Kategori</label>
                            <input type="text" name="category" id="editKategori" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-slate-700">Varian</label>
                            <input type="text" name="variants" id="editVariants" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-slate-700">Deskripsi</label>
                            <textarea name="description" id="editDescription" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500" rows="4"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700">Ganti Foto</label>
                            <input type="file" name="photo" class="mt-2 w-full rounded-2xl border border-dashed border-emerald-200 bg-emerald-50/60 px-4 py-3 text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-800 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-emerald-900">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700">Tambah Foto Lain</label>
                            <input type="file" name="photos[]" multiple class="mt-2 w-full rounded-2xl border border-dashed border-emerald-200 bg-emerald-50/60 px-4 py-3 text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-800 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-emerald-900">
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <button type="button" onclick="closeEditModal()" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-700 transition hover:bg-slate-50">Batal</button>
                        <button type="submit" class="rounded-2xl bg-emerald-800 px-5 py-3 text-sm font-black text-white shadow-lg shadow-emerald-900/20 transition hover:bg-emerald-900">Simpan</button>
                    </div>
                </form>

                <button onclick="closeEditModal()" class="absolute right-5 top-5 grid h-10 w-10 place-items-center rounded-2xl bg-slate-100 text-xl font-bold text-slate-700 transition hover:bg-slate-200">&times;</button>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id) {
            fetch(`/products/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('editNama').value = data.nama;
                    document.getElementById('editJumlah').value = data.jumlah;
                    document.getElementById('editHarga').value = data.harga;
                    document.getElementById('editDiskon').value = data.discount_percentage ?? 0;
                    document.getElementById('editKategori').value = data.category;
                    document.getElementById('editDescription').value = data.description ?? '';
                    document.getElementById('editVariants').value = Array.isArray(data.variants) ? data.variants.join(',') : (data.variants ?? '');
                    document.getElementById('editProductId').value = id;
                    document.getElementById('editProductForm').action = `/products/${id}`;
                    document.getElementById('editModal').classList.remove('hidden');
                    document.getElementById('editModal').classList.add('flex');
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }
    </script>
</x-admin-layout>
