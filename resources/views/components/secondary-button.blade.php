<button {{ $attributes->merge(['type' => 'button', 'class' => 'market-button-outline disabled:opacity-25']) }}>
    {{ $slot }}
</button>
