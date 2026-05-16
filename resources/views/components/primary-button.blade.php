<button {{ $attributes->merge(['type' => 'submit', 'class' => 'market-button']) }}>
    {{ $slot }}
</button>
