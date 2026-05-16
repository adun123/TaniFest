<x-admin-layout>
    <x-slot name="header">
        {{ __('Category Banner') }}
    </x-slot>

    <div class="space-y-8">
        <section class="overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-emerald-950 to-emerald-800 p-6 text-white shadow-2xl shadow-emerald-950/20 sm:p-8">
            <div class="grid gap-6 lg:grid-cols-5 lg:items-end">
                <div class="lg:col-span-3">
                    <p class="text-sm font-bold uppercase tracking-widest text-emerald-200">Etalase kategori</p>
                    <h2 class="mt-3 max-w-3xl text-3xl font-black tracking-tight sm:text-4xl">Banner kategori yang terasa segar sejak halaman pertama.</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-emerald-50/80">Unggah visual kategori untuk menonjolkan hasil tani dan menjaga tampilan pelanggan tetap konsisten.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur lg:col-span-2">
                    <p class="text-sm font-semibold text-emerald-100">Total banner</p>
                    <p class="mt-2 text-4xl font-black">{{ count($categories) }}</p>
                    <p class="mt-2 text-xs text-emerald-100/80">Kategori yang dikirim dari controller saat ini.</p>
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
                <p class="font-black">Banner kategori belum bisa disimpan.</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="grid gap-8 lg:grid-cols-5">
            <form action="{{ route('category-banners.store') }}" method="POST" enctype="multipart/form-data" class="rounded-3xl border border-emerald-100 bg-white p-5 shadow-xl shadow-emerald-950/5 sm:p-6 lg:col-span-2">
                @csrf
                <div class="mb-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Tambah banner</p>
                    <h3 class="mt-2 text-2xl font-black text-slate-950">Visual kategori baru</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Gunakan judul yang sama dengan kategori pelanggan agar banner mudah dipetakan.</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-bold text-slate-700">Judul Kategori</label>
                        <input type="text" name="title" id="title" class="mt-2 w-full rounded-2xl border-slate-200 bg-stone-50 px-4 py-3 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" value="{{ old('title') }}" required>
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-bold text-slate-700">Gambar</label>
                        <input type="file" name="image" id="image" class="mt-2 w-full rounded-2xl border border-dashed border-emerald-200 bg-emerald-50/60 px-4 py-3 text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-800 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-emerald-900">
                    </div>
                </div>

                <button type="submit" class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-emerald-800 px-5 py-3 text-sm font-black text-white shadow-lg shadow-emerald-900/20 transition hover:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    Tambah Banner
                </button>
            </form>

            <div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-xl shadow-emerald-950/5 sm:p-6 lg:col-span-3">
                <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Galeri banner</p>
                        <h3 class="mt-2 text-2xl font-black text-slate-950">Daftar Kategori</h3>
                    </div>
                    <p class="text-sm font-medium text-slate-500">Kartu tetap rapi di desktop dan mobile.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse ($categories as $category)
                        <article class="group overflow-hidden rounded-3xl border border-slate-100 bg-stone-50 shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-950/10">
                            <div class="relative h-40 overflow-hidden bg-emerald-100">
                                @if ($category->image_url)
                                    <img src="{{ asset('storage/' . $category->image_url) }}" alt="{{ $category->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="grid h-full w-full place-items-center bg-gradient-to-br from-emerald-100 to-stone-200 text-sm font-black text-emerald-800">Belum ada gambar</div>
                                @endif
                                <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-slate-950/60 to-transparent"></div>
                            </div>
                            <div class="p-4">
                                <p class="truncate text-lg font-black text-slate-950">{{ $category->title }}</p>
                                <form action="{{ route('category-banners.destroy', $category) }}" method="POST" class="mt-4" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline-flex w-full items-center justify-center rounded-2xl bg-red-50 px-4 py-2 text-sm font-black text-red-700 transition hover:bg-red-100">Hapus Banner</button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full rounded-3xl border border-dashed border-emerald-200 bg-emerald-50/60 p-8 text-center">
                            <p class="text-lg font-black text-emerald-900">Belum ada kategori banner.</p>
                            <p class="mt-2 text-sm text-emerald-800/80">Tambahkan banner pertama melalui form di samping.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</x-admin-layout>
