@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'market-input']) }}>
