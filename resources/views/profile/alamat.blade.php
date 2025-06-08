<div class="max-w-4xl mx-auto px-4 py-6">

    @if ($user->addresses->isEmpty())
        {{-- Jika belum ada alamat --}}
        <div class="text-center mt-6">
            <h2 class="text-2xl font-bold text-gray-700">Belum ada alamat tersimpan</h2>
            <p class="text-sm text-gray-500 mt-2">Yuk, tambah alamatmu biar lebih mudah saat checkout di TANIFEAST</p>
            <button onclick="document.getElementById('modal').classList.remove('hidden')" 
                class="mt-4 bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
                Tambah Alamat
            </button>
        </div>
    @else
        {{-- Jika sudah ada alamat --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Daftar Alamat</h2>
            <button onclick="document.getElementById('modal').classList.remove('hidden')" 
                class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
                Tambah Alamat
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            @foreach ($user->addresses as $address)
                <div class="bg-white border rounded-lg p-4 shadow-sm relative">
                    <form method="POST" action="{{ route('profile.address.destroy', $address->id) }}" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                    <p class="font-semibold">{{ $address->recipient_name }}</p>
                    <p class="text-sm text-gray-600">{{ $address->phone }}</p>
                    <p class="text-sm text-gray-700 mt-1">{{ $address->full_address }}</p>
                    <p class="text-sm text-gray-500">Kode Pos: {{ $address->postal_code }}</p>

                    <button onclick="openEditModal({{ $address }})" 
                        class="mt-3 text-sm text-blue-600 hover:underline">
                        Ubah Alamat
                    </button>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Modal Tambah Alamat --}}
    <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg relative">
            <button class="absolute top-2 right-3 text-gray-600 text-xl" onclick="document.getElementById('modal').classList.add('hidden')">&times;</button>
            <h3 class="text-lg font-semibold mb-4">Tambah Alamat</h3>

            <form method="POST" action="{{ route('profile.address.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="recipient_name" class="block font-medium">Nama Penerima</label>
                    <input type="text" id="recipient_name" name="recipient_name" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block font-medium">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                </div>

                <div class="mb-4">
                    <label for="full_address" class="block font-medium">Alamat Lengkap</label>
                    <textarea id="full_address" name="full_address" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="postal_code" class="block font-medium">Kode Pos</label>
                    <input type="text" id="postal_code" name="postal_code" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Simpan Alamat
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit Alamat --}}
    <div id="edit-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg relative">
            <button class="absolute top-2 right-3 text-gray-600 text-xl" onclick="document.getElementById('edit-modal').classList.add('hidden')">&times;</button>
            <h3 class="text-lg font-semibold mb-4">Ubah Alamat</h3>

            <form id="edit-address-form" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit_recipient_name" class="block font-medium">Nama Penerima</label>
                    <input type="text" id="edit_recipient_name" name="recipient_name" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                </div>

                <div class="mb-4">
                    <label for="edit_phone" class="block font-medium">Nomor Telepon</label>
                    <input type="text" id="edit_phone" name="phone" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                </div>

                <div class="mb-4">
                    <label for="edit_full_address" class="block font-medium">Alamat Lengkap</label>
                    <textarea id="edit_full_address" name="full_address" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="edit_postal_code" class="block font-medium">Kode Pos</label>
                    <input type="text" id="edit_postal_code" name="postal_code" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Update Alamat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(address) {
            document.getElementById('edit-modal').classList.remove('hidden');
            document.getElementById('edit_recipient_name').value = address.recipient_name;
            document.getElementById('edit_phone').value = address.phone;
            document.getElementById('edit_full_address').value = address.full_address;
            document.getElementById('edit_postal_code').value = address.postal_code;
            document.getElementById('edit-address-form').action = `/profile/address/${address.id}`;
        }
    </script>
</div>
