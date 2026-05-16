<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="market-eyebrow">Private area</p>
        <h1 class="mt-2 text-2xl font-black text-[#243126]">Konfirmasi password</h1>
        <p class="mt-3 text-sm leading-6 text-[#66725f]">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
    </div>
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <x-primary-button class="w-full">{{ __('Confirm') }}</x-primary-button>
    </form>
</x-guest-layout>
