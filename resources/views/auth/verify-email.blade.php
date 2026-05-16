<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="market-eyebrow">Almost there</p>
        <h1 class="mt-2 text-2xl font-black text-[#243126]">Verifikasi email</h1>
        <p class="mt-3 text-sm leading-6 text-[#66725f]">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
    </div>
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-2xl bg-[#edf4df] p-4 text-sm font-semibold text-[#256f46]">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</div>
    @endif
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>{{ __('Resend Verification Email') }}</x-primary-button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm font-bold text-[#b9572d] hover:text-[#15452f]">{{ __('Log Out') }}</button>
        </form>
    </div>
</x-guest-layout>
