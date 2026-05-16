@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-black uppercase tracking-[0.16em] text-[#66725f]']) }}>
    {{ $value ?? $slot }}
</label>
