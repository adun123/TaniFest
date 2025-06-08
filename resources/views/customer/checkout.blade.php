<x-app-layout>
<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <div class="col-md-8">
            {{-- Alamat Pengiriman --}}
            <div class="card ">
                <div class="card-body">
                    <h5>
                        <i class="bi bi-house-door-fill me-2"></i>Alamat Pengiriman
                        <a href="#" class="float-end text-success">Ubah</a>
                    </h5>
                    @if($selectedAddress)
                        <strong>{{ $selectedAddress->recipient_name }}</strong> - {{ $selectedAddress->phone }}<br>
                        {{ $selectedAddress->full_address }}
                    @else
                         <div class="alert alert-warning mt-3">
                            Kamu belum memilih alamat pengiriman. Silakan tambahkan di <a href="{{ route('profile.edit') }}">profil kamu</a>.
                        </div>
                    @endif

                    {{-- Pilih Hari --}}
                    {{-- Pilih Hari --}}
                    <div class="mt-3">
                        <label for="delivery_day">Pilih Hari Pengiriman</label>
                        <select id="delivery_day_selector" class="form-select rounded-lg bg-green-700 text-white " style="width: 180px;">
                            <option value="today">Hari Ini</option>
                            <option value="choose_date">Pilih Tanggal</option>
                        </select>
                    </div>

                    {{-- Tanggal Manual --}}
                    <div class="mt-2 rounded-lg bg-green-700 text-white border-green-700 w-48" id="date_picker_container" style="display: none;">
                        <label for="date_picker">Pilih Tanggal</label>
                        <input type="date" id="date_picker" class="form-control bg-green-700">
                    </div>

                    
                    {{-- Pilih Jam --}}
                    <div class="mt-2">
                        <label for="delivery_time">Pilih Jam Pengiriman</label>
                        <select name="delivery_time" id="delivery_time" class="form-select rounded-lg  border-green-700 w-48">
                            <option value="08:00 - 10:00">08:00 - 10:00</option>
                            <option value="12:00 - 14:00">12:00 - 14:00</option>
                            <option value="18:00 - 20:00">18:00 - 20:00</option>
                        </select>
                    </div>

                </div>
            </div>

            {{-- Daftar Produk --}}
            {{-- Daftar Produk & Resep --}}
            @foreach ($cartItems as $cart)
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="mr-3 self-center">
                            {{ $cart->quantity }}x
                        </div>

                        @if ($cart->product)
                            <img src="{{ asset('storage/' . $cart->product->photo) }}" alt="{{ $cart->product->nama }}" class="me-3" width="80">
                            <div>
                                <strong>{{ $cart->product->nama }}</strong><br>
                                {{ $cart->product->variants ?? '1 pack' }}<br>
                                Rp. {{ number_format($cart->product->harga, 0, ',', '.') }}
                            </div>
                        @elseif ($cart->resep)
                            <img src="{{ asset('storage/' . $cart->resep->foto) }}" alt="{{ $cart->resep->nama }}" class="me-3" width="80">
                            <div>
                                <strong>{{ $cart->resep->nama }}</strong><br>
                                Kategori: {{ $cart->resep->kategori ?? '-' }}<br>
                                Rp. {{ number_format($cart->resep->harga, 0, ',', '.') }}
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach


            {{-- Metode Pembayaran --}}
            {{-- <div class="card">
                <div class="card-body">
                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" class="form-select">
                        <option value="ewallet">eWallet</option>
                        <option value="bank">Transfer Bank</option>
                    </select>
                </div>
            </div> --}}
            <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">Metode Pembayaran</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($paymentMethods as $method)
                                <button type="button" class="btn btn-outline-success payment-method-btn"
                                        data-method="{{ $method['value'] }}">
                                    {{ $method['label'] }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Transfer Bank Section --}}
                <div id="transfer-bank-section" class="card mb-4 d-none">
                    <div class="card-body">
                        <h5 class="mb-3">Pilih Bank</h5>
                        <div class="row">
                            @foreach ($banks as $bank)
                                <div class="col-md-6 mb-3">
                                    <label class="d-flex align-items-center border p-2 rounded w-100" style="cursor: pointer;">
                                        <img src="{{ asset('images/bank/' . $bank['logo']) }}" alt="{{ $bank['name'] }}" width="50" class="me-3">
                                        <div class="flex-grow-1">{{ $bank['name'] }}</div>
                                        <input type="radio" name="bank_option_radio" class="bank-radio" value="{{ $bank['name'] }}">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Section untuk metode lain --}}
                <div id="other-method-section" class="card d-none">
                    <div class="card-body">
                        <p id="method-desc" class="mb-0">Silakan lanjutkan dengan metode pembayaran yang dipilih.</p>
                    </div>
                </div>

            </div>

        {{-- Ringkasan --}}
        {{-- Ringkasan --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Voucher Promo</h5>
                    <button class="btn btn-outline-secondary btn-sm mb-3 w-100">Pakai Voucher</button>

                    <h6>Pesanan</h6>
                    @foreach ($cartItems as $cart)
                        @if ($cart->product)
                            <p>{{ $cart->quantity }}x {{ $cart->product->nama }}
                                <span class="float-end">Rp. {{ number_format($cart->product->harga * $cart->quantity, 0, ',', '.') }}</span>
                            </p>
                        @elseif ($cart->resep)
                            <p>{{ $cart->quantity }}x {{ $cart->resep->nama }}
                                <span class="float-end">Rp. {{ number_format($cart->resep->harga * $cart->quantity, 0, ',', '.') }}</span>
                            </p>
                        @endif
                    @endforeach

                    <h6 class="mt-3">Pengiriman</h6>
                    <p>Hari Ini <span class="float-end">Rp. {{ number_format($shippingCost, 0, ',', '.') }}</span></p>

                    <hr>

                    <p>Total <span class="float-end fw-bold">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span></p>

                    {{-- Error Handling --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Form Pembayaran --}}
                    <form action="{{ route('checkout.pay') }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" name="address_id" value="{{ $selectedAddress?->id }}">
                        <input type="hidden" name="delivery_day" id="final_delivery_day" value="{{ old('delivery_day') }}">
                        <input type="hidden" name="delivery_time" id="form_delivery_time" value="{{ old('delivery_time') }}">
                        <input type="hidden" name="payment_method" id="form_payment_method" value="{{ old('payment_method') }}">
                        <input type="hidden" name="bank_option" id="form_bank_option" value="{{ old('bank_option') }}">

                        <button type="submit" class="btn btn-success w-100 mt-3" id="submit-btn">Bayar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {

    const deliveryOption = document.getElementById('delivery_day_selector'); // ✅ baru
    const datePickerContainer = document.getElementById('date_picker_container');
    const datePicker = document.getElementById('date_picker');
    const finalDeliveryDay = document.getElementById('final_delivery_day');

    function setTodayDate() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
    }

    // Inisialisasi saat load
    finalDeliveryDay.value = setTodayDate();
    

    deliveryOption.addEventListener('change', function () {
        if (this.value === 'choose_date') {
            datePickerContainer.style.display = 'block';
            finalDeliveryDay.value = ''; // kosongkan sampai user pilih tanggal
        } else {
            datePickerContainer.style.display = 'none';
            finalDeliveryDay.value = setTodayDate();
        }
    });

    datePicker.addEventListener('change', function () {
        finalDeliveryDay.value = this.value;
    });
     const deliveryTime = document.getElementById('delivery_time');
    document.getElementById('form_delivery_time').value = deliveryTime.value;

    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
            const finalDeliveryDay = document.getElementById('final_delivery_day');
            const deliveryTime = document.getElementById('delivery_time');
            const paymentMethodHidden = document.getElementById('form_payment_method');
            const bankOptionHidden = document.getElementById('form_bank_option');

            let isValid = true;
            if (!finalDeliveryDay.value) {
                alert('Harap pilih tanggal pengiriman.');
                e.preventDefault();
                return;
            }

            // Validasi dan warning untuk payment method
            if (!paymentMethodHidden.value) {
                alert('Harap pilih metode pembayaran.');
                e.preventDefault();
                return;
            }

            // Jika user pilih transfer_bank, pastikan bank_option terisi
            if (paymentMethodHidden.value === 'transfer_bank' && !bankOptionHidden.value) {
                alert('Harap pilih bank untuk transfer.');
                e.preventDefault();
                return;
            }

             if (!isValid) {
            e.preventDefault();
            return false;
        }
            const deliveryTimeValue = deliveryTime.options[deliveryTime.selectedIndex].value;
            document.getElementById('form_delivery_time').value = deliveryTimeValue;
            // Set nilai sebelum submit
    formDeliveryTime.value = deliveryTime.value;
            console.log('SUBMIT:');
            console.log('Delivery Day:', finalDeliveryDay.value);
            console.log('Delivery Time:', deliveryTimeValue);
            console.log('Payment Method:', paymentMethodHidden.value);
            console.log('Bank Option:', bankOptionHidden.value);
        });






     document.querySelectorAll('.payment-method-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const method = this.dataset.method;

            document.getElementById('form_payment_method').value = method;

            // Toggle tampilan
            document.getElementById('transfer-bank-section').classList.add('d-none');
            document.getElementById('other-method-section').classList.add('d-none');

            if (method === 'transfer_bank') {
                document.getElementById('transfer-bank-section').classList.remove('d-none');
            } else {
                document.getElementById('other-method-section').classList.remove('d-none');
                document.getElementById('method-desc').textContent = 'Anda memilih metode: ' + method.toUpperCase().replace('_', ' ');
            }

            // Highlight tombol aktif
            document.querySelectorAll('.payment-method-btn').forEach(btn => btn.classList.remove('btn-success'));
            this.classList.add('btn-success');
        });
    });

    // Simpan bank_option ke hidden input saat user pilih
    document.querySelectorAll('.bank-radio').forEach(radio => {
        radio.addEventListener('change', function () {
            document.getElementById('form_bank_option').value = this.value;
        });
    });


});
</script>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif





</x-app-layout>

