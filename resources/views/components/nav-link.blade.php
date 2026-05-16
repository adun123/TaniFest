@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-full bg-[#256f46] px-4 py-2 text-sm font-bold text-white shadow-lg shadow-green-900/20 transition duration-150 ease-in-out'
            : 'inline-flex items-center rounded-full px-4 py-2 text-sm font-bold text-[#3f503c] transition duration-150 ease-in-out hover:bg-[#edf4df] hover:text-[#15452f]';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
