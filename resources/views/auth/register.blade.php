<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | TaniFest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 p-0 overflow-hidden">

    <div class="flex w-screen h-screen">
        <!-- Left Side (Form) -->
        <div class="w-full md:w-1/2 flex flex-col justify-center px-10 overflow-y-auto py-8">
            <!-- Logo -->
            <div class="flex justify-left mb-5 mt-10">
                <img src="/images/logo.svg" alt="TaniFest Logo" class="h-20">
            </div>

            <h2 class="text-2xl font-bold text-center mb-6">Registrasi Akun</h2>

            <!-- Ganti bagian form ini dalam register.blade.php -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- First & Last Name -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Depan</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Nama Depan"
                            value="{{ old('first_name') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 focus:outline-none"
                            required>
                        <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
                    </div>
                    <div class="w-1/2">
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Belakang</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Nama Belakang"
                            value="{{ old('last_name') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 focus:outline-none"
                            required>
                        <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
                    </div>
                </div>

                {{-- <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 focus:outline-none"
                        required>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div> --}}

                <!-- Phone -->
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                    <input
                            type="text"
                            id="phone"
                            name="phone"
                            placeholder="08xxxxxxxxxx"
                            value="{{ old('phone') }}"
                            inputmode="numeric"
                            pattern="\d*"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 focus:outline-none"
                            required
                        >
                    <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Kata Sandi"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 focus:outline-none"
                        required>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Kata Sandi"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 focus:outline-none"
                        required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <!-- Tombol Daftar -->
                <div class="mb-4">
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded transition">
                        Daftar
                    </button>
                </div>

                <!-- Google Register -->
                {{-- <div class="mb-4">
                    <a href="{{ route('google.login') }}"
                        class="w-full flex items-center justify-center border border-gray-300 rounded py-2 hover:bg-gray-100 transition">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5 mr-2" alt="Google">
                        <span class="text-sm text-gray-700">Daftar dengan Google</span>
                    </a>
                </div> --}}

                <!-- Sudah punya akun? -->
                <div class="text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-green-600 font-medium hover:underline">Login</a>
                </div>
            </form>

            @if ($errors->any())
                <div class="mt-4 text-red-600 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Right Side (Image) -->
        <div class="hidden md:block md:w-1/2 h-full">
            <img src="{{ asset('images/login-image.svg') }}" alt="Register Background" class="w-full h-full object-cover">
        </div>
    </div>

</body>
</html>
