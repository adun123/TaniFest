<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TaniFest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 p-0 overflow-hidden">

    <div class="flex w-screen h-screen">
        <!-- Left Side (Form) -->
        <div class="w-full md:w-1/2 flex flex-col justify-center px-10">
            <!-- Logo -->
            <div class="flex justify-left mb-20">
                <img src="/images/logo.svg" alt="TaniFest Logo" class="h-20">
            </div>

            <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <input
                        id="email"
                        name="login"
                        type="text"
                        placeholder="Email / No Handphone"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ old('email') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                        required
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Forgot Password -->
                <div class="flex justify-end mb-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:underline">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mb-4">
                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded">
                        Login
                    </button>
                </div>

                <!-- Atau -->
                <div class="flex items-center mb-4">
                    <hr class="flex-grow border-t border-gray-300">
                    <span class="mx-4 text-sm text-gray-400">ATAU</span>
                    <hr class="flex-grow border-t border-gray-300">
                </div>

                <!-- Google Login -->
                <div class="mb-4">
                    <a href="#" class="w-full flex items-center justify-center border border-gray-300 rounded py-2 hover:bg-gray-100 transition">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5 mr-2" alt="Google">
                        <span class="text-sm text-gray-700">Google</span>
                    </a>
                </div>

                <!-- Register Link -->
                <div class="text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-green-600 font-medium hover:underline">Registrasi</a>
                </div>
            </form>
        </div>

        <!-- Right Side (Image) -->
        <div class="hidden md:block md:w-1/2 h-full">
            <img src="{{ asset('images/login-image.svg') }}" alt="Login Background" class="w-full h-full object-cover">
        </div>

</body>
</html>
