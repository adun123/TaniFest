<div class="max-w-7xl  mx-auto px-4 py-6">

    <!-- Content -->
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Profile Photo -->
        <div class="bg-white border rounded-xl p-6 text-center">
            <div class="w-64 h-64 mx-auto flex items-center justify-center border rounded-lg bg-green-600 overflow-hidden">
                @if($user->photo)
                    <img src="{{ asset('storage/'.$user->photo) }}" class="object-cover w-full h-full">
                @else
                    <span class="text-5xl text-gray-500">Tidak ada foto</span>
                @endif
            </div>

            <button class="mt-4 w-full border border-green-500 text-green-600 hover:bg-green-50 rounded-lg py-2"
                data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-camera mr-2"></i>Edit Foto
            </button>
            <button onclick="document.getElementById('passwordModal').classList.remove('hidden')"
                class="mt-4 w-full border border-green-500 text-green-600 hover:bg-green-50 rounded-lg py-2">
              Ubah Password
            </button>

        </div>

        <!-- Biodata -->
        <div class="md:col-span-2 bg-white border rounded-xl p-6">
            <h5 class="text-lg font-semibold mb-4">Ubah Biodata Diri</h5>
            <div class="mb-4">
                <span class="font-semibold">Nama:</span> {{ $user->name }}
            </div>
            <div class="mb-4">
                <span class="font-semibold">Email:</span> {{ $user->email }}
            </div>
            <div class="mb-4">
                <span class="font-semibold">Nomor HP:</span> {{ $user->phone ?? '-' }}
            </div>

            <button type="button"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700"
                data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="fas fa-edit mr-2"></i>Edit Profile
            </button>
        </div>
    </div>
</div>


<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-bottom">
    <div class="modal-content rounded-top-4">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="editProfileModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="modal-body">

          <!-- Foto -->
          <div class="text-center mb-4">
            @if($user->photo)
              <img src="{{ asset('storage/'.$user->photo) }}" id="profilePhotoPreview"
                   class="rounded-circle w-24 h-24 object-cover mx-auto mb-2">
            @else
              <div id="profilePhotoPreview" class="rounded-circle bg-light w-24 h-24 d-flex justify-content-center align-items-center mx-auto mb-2 text-muted">
                  No Photo
              </div>
            @endif
            <div class="mt-2">
              <label for="photo" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-upload me-1"></i> Upload Foto
              </label>
              <input type="file" id="photo" name="photo" class="d-none" accept="image/*">
              <x-input-error class="mt-2 text-danger small" :messages="$errors->get('photo')" />
            </div>
          </div>

          <!-- Nama -->
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control">
            <x-input-error class="mt-1 text-danger small" :messages="$errors->get('name')" />
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
            <x-input-error class="mt-1 text-danger small" :messages="$errors->get('email')" />
          </div>

          <!-- Telepon -->
          <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
            <x-input-error class="mt-1 text-danger small" :messages="$errors->get('phone')" />
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>
<style>
    [x-cloak] { display: none !important; }
</style>

  @push('scripts')
  <script>
      document.getElementById('photo').addEventListener('change', function(e) {
          const file = e.target.files[0];
          if (file) {
              const reader = new FileReader();
              reader.onload = function(event) {
                  const preview = document.getElementById('profilePhotoPreview');
                  if (preview.tagName === 'DIV') {
                      const img = document.createElement('img');
                      img.src = event.target.result;
                      img.className = 'rounded-circle w-24 h-24 object-cover mx-auto mb-3';
                      preview.parentNode.replaceChild(img, preview);
                      img.id = 'profilePhotoPreview';
                  } else {
                      preview.src = event.target.result;
                  }
              };
              reader.readAsDataURL(file);
          }
      });
      </script>
      
  @endpush

  <!-- Modal Ubah Password -->
<div id="passwordModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-xl relative">
        <button class="absolute top-2 right-3 text-gray-600 text-xl"
            onclick="document.getElementById('passwordModal').classList.add('hidden')">&times;</button>

        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Ubah Password') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman..') }}
                </p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div>
                    <x-input-label for="update_password_current_password" :value="__('Password Saat ini')" />
                    <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="update_password_password" :value="__('Password Baru')" />
                    <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password Baru')" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="ml-auto">{{ __('Simpan') }}</x-primary-button>
                </div>

                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif
            </form>
        </section>
    </div>
</div>

