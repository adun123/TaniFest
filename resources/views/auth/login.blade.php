<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Tani Feast</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#fff8ec] text-[#243126]">
    <div class="grid min-h-screen lg:grid-cols-[0.9fr_1.1fr]">
        <div class="flex items-center justify-center px-6 py-10">
            <div class="w-full max-w-md rounded-[2rem] border border-white/80 bg-white/85 p-8 shadow-[0_24px_70px_rgba(59,74,43,0.16)] backdrop-blur">
                <img src="/images/logo.svg" alt="TaniFest Logo" class="mb-8 h-16">
                <p class="text-xs font-black uppercase tracking-[0.28em] text-[#b9572d]">Welcome back</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight">Masuk ke pasar segar Anda</h1>
                <p class="mt-3 text-sm leading-6 text-[#66725f]">Lanjutkan belanja bahan pilihan, resep, dan pesanan harian Tani Feast.</p>

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-4">
                    @csrf
                    <div>
                        <input id="email" name="login" type="text" placeholder="Email / No Handphone" class="w-full rounded-2xl border border-[#f0dfbd] bg-white px-4 py-3 text-sm focus:border-[#256f46] focus:ring-[#256f46]" value="{{ old('login') }}" required />
                        <x-input-error :messages="$errors->get('login')" class="mt-2" />
                    </div>
                    <div>
                        <input id="password" name="password" type="password" placeholder="Password" class="w-full rounded-2xl border border-[#f0dfbd] bg-white px-4 py-3 text-sm focus:border-[#256f46] focus:ring-[#256f46]" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="flex justify-end">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#256f46] hover:text-[#15452f]">Lupa Password?</a>
                        @endif
                    </div>
                    <button type="submit" class="w-full rounded-full bg-[#256f46] py-3 font-black text-white shadow-lg shadow-green-900/20 transition hover:bg-[#15452f]">Login</button>
                    <div class="flex items-center gap-4 py-2"><hr class="flex-1 border-[#ead8b7]"><span class="text-xs font-black tracking-[0.2em] text-[#66725f]">ATAU</span><hr class="flex-1 border-[#ead8b7]"></div>
                    <a href="#" class="flex w-full items-center justify-center rounded-full border border-[#ead8b7] bg-white py-3 font-bold text-[#3f503c] transition hover:bg-[#edf4df]">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="mr-2 h-5 w-5" alt="Google"> Google
                    </a>
                    <div class="text-center text-sm text-[#66725f]">Belum punya akun? <a href="{{ route('register') }}" class="font-black text-[#256f46] hover:text-[#15452f]">Registrasi</a></div>
                </form>
            </div>
        </div>
        <div class="relative hidden overflow-hidden bg-[#15452f] lg:block">
            <img src="{{ asset('images/login-image.svg') }}" alt="Login Background" class="absolute inset-0 h-full w-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-br from-[#15452f]/80 via-[#256f46]/35 to-[#dba84b]/25"></div>
            <div class="absolute bottom-10 left-10 right-10 rounded-[2rem] border border-white/20 bg-white/15 p-8 text-white backdrop-blur">
                <p class="text-sm font-black uppercase tracking-[0.25em] text-[#f6d28a]">Fresh market ecommerce</p>
                <h2 class="mt-3 max-w-xl text-4xl font-black leading-tight">Bahan segar dan resep pilihan, siap dikirim ke rumah.</h2>
            </div>
        </div>
    </div>
</body>
</html>
