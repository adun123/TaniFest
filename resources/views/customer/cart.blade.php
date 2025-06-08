<x-app-layout>
   

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
                                <input 
                                        type="checkbox" 
                                        class="cart-checkbox" 
                                        data-id="{{ $item->id ?? $item->resep->id ?? $item->product->id }}"
                                    >
                                <div class="flex-shrink-0 w-20 h-20">
                                    @if($item->product && $item->product->photo)
                                        <img src="{{ asset('storage/'.$item->product->photo) }}" class="object-cover w-full h-full rounded">
                                    @elseif($item->resep && $item->resep->foto)
                                        <img src="{{ asset('storage/'.$item->resep->foto) }}" class="object-cover w-full h-full rounded">
                                    @else
                                        <div class="bg-gray-200 flex items-center justify-center w-full h-full rounded text-sm text-gray-500">No Image</div>
                                    @endif
                                </div>

                                <div class="flex-grow">
                                    <h3 class="font-bold text-lg">
                                        {{ $item->product->nama ?? $item->resep->nama }}
                                    </h3>

                                    @if($item->product)
                                        <p class="text-sm text-gray-500">Stok: {{ $item->product->variants }}</p>
                                        <p class="text-green-600 font-semibold">Rp {{ number_format($item->product->harga) }}</p>
                                    @elseif($item->resep)
                                        <p class="text-sm text-gray-500">Kategori: {{ $item->resep->kategori ?? '-' }}</p>
                                        <p class="text-green-600 font-semibold">Rp {{ number_format($item->resep->harga) }}</p>
                                    @endif
                                </div>

                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2" id="quantity-form-{{ $item->id }}">
                                    @csrf
                                    @method('PATCH')

                                    <button type="button" onclick="updateQuantity({{ $item->id }}, -1, 99)" class="px-2 py-1 bg-gray-200 rounded">-</button>

                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        id="quantity-input-{{ $item->id }}" 
                                        min="1" 
                                        value="{{ $item->quantity }}" 
                                        class="w-16 border rounded text-center" 
                                        readonly
                                    >

                                    <button type="button" onclick="updateQuantity({{ $item->id }}, 1, 99)" class="px-2 py-1 bg-gray-200 rounded">+</button>
                                </form>

                                <form action="{{ route('cart.destroy', $item) }}" method="POST" class="inline" id="delete-form-{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')       
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
                        <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form" class="mt-4">
                            @csrf
                            <div id="cart-ids-container"></div> <!-- tempat hidden input akan disisipkan -->

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



        const cartIdsContainer = document.getElementById('cart-ids-container');

        function renderSelectedItems() {
            selectedItemsContainer.innerHTML = '';
            cartIdsContainer.innerHTML = ''; // Bersihkan dulu hidden input-nya

            selectedItems.forEach(item => {
                const el = document.createElement('div');
                el.classList.add('flex', 'justify-between', 'text-sm');
                el.innerHTML = `
                    <p>${item.qty}x</p>
                    <img src="${item.photo}" alt="${item.name}" class="w-12 h-12 object-cover rounded">
                    <p>${item.name}</p>
                    <span>Rp ${item.price.toLocaleString()}</span>
                `;
                selectedItemsContainer.appendChild(el);

                // Tambahkan input hidden untuk cart_id
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'cart_ids[]';
                input.value = item.id;
                cartIdsContainer.appendChild(input);
            });

            totalPriceEl.innerText = 'Rp ' + totalPrice.toLocaleString();
            checkoutBtn.disabled = selectedItems.length === 0;
        }

    </script>
    <script>
    function updateQuantity(itemId, change, maxQuantity = 99) {
        const input = document.getElementById(`quantity-input-${itemId}`);
        let currentQuantity = parseInt(input.value);

        if (isNaN(currentQuantity)) currentQuantity = 1;

        const newQuantity = currentQuantity + change;

        // Jika kurang dari 1, hapus item
        if (newQuantity <= 0) {
            document.getElementById(`delete-form-${itemId}`).submit();
            return;
        }

        // Batasi ke maksimum jika ada batasan
        if (newQuantity > maxQuantity) return;

        input.value = newQuantity;

        // Submit form update via AJAX
        const form = document.getElementById(`quantity-form-${itemId}`);
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        }).then(response => {
            if (!response.ok) {
                console.error('Update gagal');
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }
</script>

</x-app-layout>
