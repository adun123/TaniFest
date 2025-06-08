<x-app-layout>
    <div class="container py-5 text-center">
        <div class="bg-white p-5 rounded shadow-sm mx-auto" style="max-width: 500px;">
            <h2 class="text-success mb-3">Pembayaran Berhasil!</h2>
            <p class="mb-4">Terima kasih telah melakukan pembelian. Berikut adalah detail transaksi Anda:</p>

            <div class="text-start mb-4">
                <p><strong>Virtual Account:</strong><br>
                    <span class="text-primary">{{ $transaction->virtual_account }}</span>
                </p>

                <p><strong>Total Bayar:</strong><br>
                    Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}
                </p>

                <p><strong>Metode Pembayaran:</strong><br>
                    {{ ucfirst($transaction->payment_method) }}
                </p>

                <p><strong>Waktu Pengiriman:</strong><br>
                    {{ ucfirst($transaction->delivery_day) }} jam {{ $transaction->delivery_time }}
                </p>
            </div>

            <a href="{{ route('customer.dashboard') }}" class="btn btn-success">Kembali ke Beranda</a>
        </div>
    </div>
</x-app-layout>
