<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Tani Feast</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#fff8ec] text-[#243126]">
    <div class="grid min-h-screen lg:grid-cols-[0.95fr_1.05fr]">
        <div class="flex items-center justify-center px-6 py-10">
            <div class="w-full max-w-lg rounded-[2rem] border border-white/80 bg-white/85 p-8 shadow-[0_24px_70px_rgba(59,74,43,0.16)] backdrop-blur">
                <img src="/images/logo.svg" alt="TaniFest Logo" class="mb-6 h-16">
                <p class="text-xs font-black uppercase tracking-[0.28em] text-[#b9572d]">Join the harvest</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight">Buat akun Tani Feast</h1>
                <form method="POST" action="{{ route('register') }}" class="mt-7 space-y-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="first_name" class="mb-1 block text-xs font-black uppercase tracking-[0.16em] text-[#66725f]">Nama Depan</label>
                            <input type="text" id="first_name" name="first_name" placeholder="Nama Depan" value="{{ old('first_name') }}" class="w-full rounded-2xl border border-[#f0dfbd] bg-white px-4 py-3 text-sm focus:border-[#256f46] focus:ring-[#256f46]" required>
                            <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
                        </div>
                        <div>
                            <label for="last_name" class="mb-1 block text-xs font-black uppercase tracking-[0.16em] text-[#66725f]">Nama Belakang</label>
                            <input type="text" id="last_name" name="last_name" placeholder="Nama Belakang" value="{{ old('last_name') }}" class="w-full rounded-2xl border border-[#f0dfbd] bg-white px-4 py-3 text-sm focus:border-[#256f46] focus:ring-[#256f46]" required>
                            <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
                        </div>
                    </div>
                    <div>
                        <label for="phone" class="mb-1 block text-xs font-black uppercase tracking-[0.16em] text-[#66725f]">No. HP</label>
                        <input type="text" id="phone" name="phone" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" inputmode="numeric" pattern="\d*" class="w-full rounded-2xl border border-[#f0dfbd] bg-white px-4 py-3 text-sm focus:border-[#256f46] focus:ring-[#256f46]" required>
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>
                    <div>
                        <label for="password" class="mb-1 block text-xs font-black uppercase tracking-[0.16em] text-[#66725f]">Kata Sandi</label>
                        <input type="password" id="password" name="password" placeholder="Kata Sandi" class="w-full rounded-2xl border border-[#f0dfbd] bg-white px-4 py-3 text-sm focus:border-[#256f46] focus:ring-[#256f46]" required>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="mb-1 block text-xs font-black uppercase tracking-[0.16em] text-[#66725f]">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Kata Sandi" class="w-full rounded-2xl border border-[#f0dfbd] bg-white px-4 py-3 text-sm focus:border-[#256f46] focus:ring-[#256f46]" required>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>
                    <button type="submit" class="w-full rounded-full bg-[#256f46] py-3 font-black text-white shadow-lg shadow-green-900/20 transition hover:bg-[#15452f]">Daftar</button>
                    <div class="text-center text-sm text-[#66725f]">Sudah punya akun? <a href="{{ route('login') }}" class="font-black text-[#256f46] hover:text-[#15452f]">Login</a></div>
                </form>
                @if ($errors->any())
                    <div class="mt-4 rounded-2xl bg-red-50 p-4 text-sm text-red-700"><ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                @endif
            </div>
        </div>
        <div class="relative hidden overflow-hidden bg-[#15452f] lg:block">
            <img src="{{ asset('images/login-image.svg') }}" alt="Register Background" class="absolute inset-0 h-full w-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-br from-[#15452f]/80 via-[#256f46]/35 to-[#dba84b]/25"></div>
        </div>
    </div>
</body>
</html>
