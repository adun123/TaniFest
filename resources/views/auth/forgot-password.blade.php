<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="market-eyebrow">Account recovery</p>
        <h1 class="mt-2 text-2xl font-black text-[#243126]">Lupa password?</h1>
        <p class="mt-3 text-sm leading-6 text-[#66725f]">Masukkan email akun Anda, kami akan mengirim tautan untuk membuat kata sandi baru.</p>
    </div>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <x-primary-button class="w-full">{{ __('Email Password Reset Link') }}</x-primary-button>
    </form>
</x-guest-layout>
