<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Keranjang Belanja</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($cartItems->isEmpty())
                <div class="bg-white p-6 text-center rounded shadow">
                    <p class="text-gray-500">Keranjang belanja Anda kosong</p>
                    <a href="{{ route('customer.dashboard') }}" class="mt-4 inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Lanjutkan Belanja
                    </a>
                </div>
            @else
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- LEFT: Produk dalam Keranjang -->
                    <div class="w-full md:w-2/3 bg-white p-6 rounded shadow space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex items-center gap-4 border-b pb-4">
                                <input type="checkbox" class="cart-checkbox" data-id="{{ $item->id }}">

                                <div class="flex-shrink-0 w-20 h-20">
                                    @if($item->product->photo)
                                        <img src="{{ asset('storage/'.$item->product->photo) }}" class="object-cover w-full h-full rounded">
                                    @else
                                        <div class="bg-gray-200 flex items-center justify-center w-full h-full rounded text-sm text-gray-500">No Image</div>
                                    @endif
                                </div>

                                <div class="flex-grow">
                                    <h3 class="font-bold text-lg">{{ $item->product->nama }}</h3>
                                    <p class="text-sm text-gray-500">Stok: {{ $item->product->jumlah }}</p>
                                    <p class="text-green-600 font-semibold">Rp {{ number_format($item->product->harga) }}</p>
                                </div>

                                <!-- Quantity -->
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" min="1" max="{{ $item->product->jumlah }}" value="{{ $item->quantity }}" class="w-16 border rounded text-center">
                                    <button type="submit" class="text-blue-500 hover:text-blue-700">Update</button>
                                </form>

                                <!-- Remove -->
                                <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <!-- RIGHT: Produk Dipilih + Checkout -->
                    <div class="w-full md:w-1/3 bg-white p-6 rounded shadow h-fit sticky top-24">
                        <h3 class="font-semibold text-lg mb-4">Informasi Produk</h3>
                        <div id="selected-items" class="space-y-3">
                            <!-- Akan diisi dengan JS -->
                        </div>
                        <div class="mt-6 border-t pt-4 flex justify-between">
                            <span class="font-bold">Total:</span>
                            <span class="font-bold" id="total-price">Rp 0</span>
                        </div>
                        <form  method="GET" class="mt-4">
                            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded disabled:opacity-50" disabled id="checkout-btn">
                                Checkout
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Script untuk handling checkbox dan total -->
    <script>
        const checkboxes = document.querySelectorAll('.cart-checkbox');
        const selectedItemsContainer = document.getElementById('selected-items');
        const totalPriceEl = document.getElementById('total-price');
        const checkoutBtn = document.getElementById('checkout-btn');

        let selectedItems = [];
        let totalPrice = 0;

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const itemId = this.dataset.id;
                const productCard = this.closest('.flex');
                const photo = productCard.querySelector('img').getAttribute('src');

                const name = productCard.querySelector('h3').innerText;
                const priceText = productCard.querySelector('.text-green-600').innerText;
                const price = parseInt(priceText.replace(/[^\d]/g, ''));
                const qty = parseInt(productCard.querySelector('input[name="quantity"]').value);

                if (this.checked) {
                    selectedItems.push({ id: itemId, name, price, qty, photo });

                    totalPrice += price * qty;
                } else {
                    selectedItems = selectedItems.filter(i => i.id !== itemId);
                    totalPrice -= price * qty;
                }

                renderSelectedItems();
            });
        });

        function renderSelectedItems() {
            selectedItemsContainer.innerHTML = '';
            selectedItems.forEach(item => {
                const el = document.createElement('div');
                el.classList.add('flex', 'justify-between', 'text-sm');
                el.innerHTML = `
                 <p>${item.qty}x</p>
                <img src="${item.photo}" alt="${item.name}" class="w-12 h-12 object-cover rounded">
                <p>  ${item.name} </p>
                <span>Rp ${item.price.toLocaleString()}</span>`;
                selectedItemsContainer.appendChild(el);
            });

            totalPriceEl.innerText = 'Rp ' + totalPrice.toLocaleString();
            checkoutBtn.disabled = selectedItems.length === 0;
        }
    </script>
</x-app-layout>
