<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-semibold mb-4">Riwayat Pesanan</h2>

        <!-- Search -->
        <div class="mb-6">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari Transaksi"
                class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <!-- Tabs -->
        <form method="GET" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2 mb-4">
            @foreach (['Semua', 'Dikemas', 'Dikirim', 'Selesai', 'Pembatalan', 'Pengembalian'] as $status)
                <button type="submit" name="status" value="{{ strtolower($status) }}"
                    class="w-full px-4 py-2 rounded-full border text-sm font-medium transition text-center
                    {{ request('status') == strtolower($status) || (request('status') == null && $status == 'Semua') 
                        ? 'bg-green-500 text-white' 
                        : 'text-gray-700 hover:bg-gray-200' }}">
                    {{ $status }}
                </button>
            @endforeach
        </form>


        

       @forelse ($transactions as $transaction)
    @foreach ($transaction->items as $item)
        <div class="border rounded-xl p-4 mb-4 shadow-sm bg-white">
            <div class="flex flex-col md:flex-row md:justify-between">
                <!-- Kiri: Item (Produk/Resep) -->
                <div class="flex gap-4">
                    @if($item->product)
                        <!-- Tampilan untuk Produk -->
                        <img src="{{ asset('storage/' . $item->product->photo) }}" alt="{{ $item->product->nama }}"
                            class="w-20 h-20 object-cover rounded-lg">
                        <div>
                            <p class="text-sm text-gray-500">{{ $item->product->category }}</p>
                            <p class="text-lg font-semibold">{{ $item->product->nama }}</p>
                            <p class="text-sm text-gray-500">300 gr / pack</p>
                            <p class="font-semibold text-gray-800">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    @elseif($item->resep)
                        <!-- Tampilan untuk Resep -->
                        <img src="{{ asset('storage/' . $item->resep->foto) }}" alt="{{ $item->resep->nama }}"
                            class="w-20 h-20 object-cover rounded-lg">
                        <div>
                            <p class="text-sm text-gray-500">Resep</p>
                            <p class="text-lg font-semibold">{{ $item->resep->nama }}</p>
                            <p class="text-sm text-gray-500">{{ $item->resep->kategori }}</p>
                            <p class="font-semibold text-gray-800">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    @endif
                </div>

                <!-- Kanan: Info Transaksi -->
                <div class="mt-4 md:mt-0 md:text-right">
                    <p class="text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($transaction->created_at)->format('d-M-Y') }}
                    </p>

                    @php
                        $statusText = ucfirst($transaction->status);
                        $badgeClass = match ($transaction->status) {
                            'selesai' => 'bg-green-100 text-green-600',
                            'dikirim' => 'bg-blue-100 text-blue-600',
                            'dikemas' => 'bg-yellow-100 text-yellow-600',
                            'pembatalan' => 'bg-red-100 text-red-600',
                            'pengembalian' => 'bg-orange-100 text-orange-600',
                            default => 'bg-yellow-200 text-gray-800',
                        };
                    @endphp

                    <span class="inline-block mt-1 px-2 py-1 text-xs rounded {{ $badgeClass }}">
                        {{ $statusText }}
                    </span>

                    <p class="text-xs text-gray-500 mt-2">{{ strtoupper("{$transaction->code}") }}</p>
                    <p class="text-sm mt-1 font-semibold">Total Harga</p>
                    <p class="text-base font-bold text-gray-800">
                        Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </p>

                    <div class="flex gap-2 justify-end mt-2">
                        <a href="#"
                            class="text-green-600 text-sm hover:underline">Lihat Detail</a>
                        @if($item->product)
                            <a href="{{ route('customer.product.show', $item->product->id) }}"
                                class="text-white bg-green-500 text-sm px-3 py-1 rounded hover:bg-green-600">Beli Lagi</a>
                        @elseif($item->resep)
                            <a href="#}"
                                class="text-white bg-green-500 text-sm px-3 py-1 rounded hover:bg-green-600">Beli Lagi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@empty
    <p class="text-center text-gray-500">Belum ada transaksi.</p>
@endforelse
    </div>
</x-app-layout>
