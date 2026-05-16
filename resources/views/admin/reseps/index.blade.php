<x-admin-layout>
    <x-slot name="header">
        {{ __('Manajemen Resep') }}
    </x-slot>

    <div class="space-y-8">
        <section class="overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-950 via-slate-900 to-lime-900 p-6 text-white shadow-2xl shadow-emerald-950/20 sm:p-8">
            <div class="grid gap-6 lg:grid-cols-5 lg:items-end">
                <div class="lg:col-span-3">
                    <p class="text-sm font-bold uppercase tracking-widest text-emerald-200">Dapur inspirasi</p>
                    <h2 class="mt-3 max-w-3xl text-3xl font-black tracking-tight sm:text-4xl">Bangun resep yang mengubah bahan tani menjadi paket bernilai.</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-emerald-50/80">Kelola nama, bahan, harga, stok, foto, dan video resep dengan alur admin yang tetap sama.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur lg:col-span-2">
                    <p class="text-sm font-semibold text-emerald-100">Total resep</p>
                    <p class="mt-2 text-4xl font-black">{{ count($reseps) }}</p>
                    <p class="mt-2 text-xs text-emerald-100/80">Resep yang dikirim dari controller saat ini.</p>
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
                <p class="font-black">Resep belum bisa disimpan.</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="grid gap-8 xl:grid-cols-5">
            <form action="{{ route('admin.reseps.store') }}" method="POST" enctype="multipart/form-data" class="rounded-3xl border border-emerald-100 bg-white p-5 shadow-xl shadow-emerald-950/5 sm:p-6 xl:col-span-2">
                @csrf
                <div class="mb-6 flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Tambah resep</p>
                        <h3 class="mt-2 text-2xl font-black text-slate-950">Paket dapur baru</h3>
                    </div>
                    <span class="rounded-full bg-lime-100 px-3 py-1 text-xs font-bold text-lime-800">Resep</span>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-slate-700">Nama Resep</label>
                        <input type="text" name="nama" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" value="{{ old('nama') }}" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-slate-700">Deskripsi</label>
                        <textarea name="deskripsi" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" rows="4">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Harga</label>
                        <input type="number" name="harga" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" value="{{ old('harga') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Stok</label>
                        <input type="number" name="stok" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" value="{{ old('stok') }}" required>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="flex items-center justify-between gap-3">
                            <label class="block text-sm font-bold text-slate-700">Bahan-bahan</label>
                            <button type="button" onclick="tambahBahan()" class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-black text-emerald-800 transition hover:bg-emerald-200">+ Tambah Bahan</button>
                        </div>
                        <div id="bahan-list" class="mt-2 space-y-2">
                            @foreach (old('bahan', ['']) as $bahan)
                                <input type="text" name="bahan[]" class="w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Contoh: 2 butir telur" value="{{ $bahan }}" required>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Foto Resep</label>
                        <input type="file" name="foto" class="mt-2 w-full rounded-2xl border border-dashed border-emerald-200 bg-emerald-50/60 px-4 py-3 text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-800 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-emerald-900">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Link Video (YouTube)</label>
                        <input type="url" name="video" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="https://youtube.com/..." value="{{ old('video') }}">
                    </div>
                </div>

                <button class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-emerald-800 px-5 py-3 text-sm font-black text-white shadow-lg shadow-emerald-900/20 transition hover:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    Simpan Resep
                </button>
            </form>

            <div class="min-w-0 rounded-3xl border border-slate-100 bg-white p-5 shadow-xl shadow-emerald-950/5 sm:p-6 xl:col-span-3">
                <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Katalog resep</p>
                        <h3 class="mt-2 text-2xl font-black text-slate-950">Daftar Resep</h3>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Tabel dapat digeser di layar kecil.</p>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-slate-100">
                    <table class="min-w-full divide-y divide-slate-100 text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-4 py-3 font-black">Nama</th>
                                <th class="px-4 py-3 font-black">Harga</th>
                                <th class="px-4 py-3 font-black">Foto</th>
                                <th class="px-4 py-3 font-black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($reseps as $resep)
                                <tr class="transition hover:bg-emerald-50/40">
                                    <td class="px-4 py-4">
                                        <p class="font-bold text-slate-900">{{ $resep->nama }}</p>
                                        @if(!empty($resep->deskripsi))
                                            <p class="mt-1 max-w-xs truncate text-xs text-slate-500">{{ $resep->deskripsi }}</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 font-semibold text-slate-900">Rp {{ number_format($resep->harga) }}</td>
                                    <td class="px-4 py-4">
                                        @if($resep->foto)
                                            <img src="{{ asset('storage/'.$resep->foto) }}" alt="{{ $resep->nama }}" class="h-14 w-14 rounded-2xl object-cover ring-1 ring-slate-100">
                                        @else
                                            <span class="grid h-14 w-14 place-items-center rounded-2xl bg-lime-50 text-xs font-black text-lime-700 ring-1 ring-lime-100">RS</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <form action="{{ route('admin.reseps.destroy', $resep) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                            @csrf @method('DELETE')
                                            <button class="rounded-xl bg-red-50 px-3 py-2 text-xs font-black text-red-700 transition hover:bg-red-100">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-10 text-center text-slate-500">Belum ada resep.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:hidden">
                    @foreach ($reseps as $resep)
                        <article class="rounded-3xl border border-slate-100 bg-stone-50 p-4">
                            <div class="flex gap-3">
                                @if($resep->foto)
                                    <img src="{{ asset('storage/'.$resep->foto) }}" alt="{{ $resep->nama }}" class="h-16 w-16 rounded-2xl object-cover">
                                @else
                                    <span class="grid h-16 w-16 place-items-center rounded-2xl bg-lime-50 text-xs font-black text-lime-700 ring-1 ring-lime-100">RS</span>
                                @endif
                                <div class="min-w-0">
                                    <p class="truncate font-black text-slate-950">{{ $resep->nama }}</p>
                                    <p class="mt-1 text-sm font-semibold text-emerald-800">Rp {{ number_format($resep->harga) }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <script>
        function tambahBahan() {
            const container = document.getElementById('bahan-list');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'bahan[]';
            input.className = 'w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500';
            input.placeholder = 'Contoh: 200gr tepung';
            container.appendChild(input);
        }
    </script>
</x-admin-layout>
