@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-2xl bg-[#256f46] px-4 py-3 text-start text-base font-bold text-white shadow-lg shadow-green-900/20 transition duration-150 ease-in-out'
            : 'block w-full rounded-2xl px-4 py-3 text-start text-base font-bold text-[#3f503c] transition duration-150 ease-in-out hover:bg-[#edf4df] hover:text-[#15452f]';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
