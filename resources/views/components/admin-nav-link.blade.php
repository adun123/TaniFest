@props(['active' => false, 'href'])

<a href="{{ $href }}" @class([
    'flex items-center px-4 py-3 text-sm font-medium transition-colors',
    'bg-gray-900 text-white' => $active,
    'text-gray-300 hover:bg-gray-700 hover:text-white' => !$active,
])>
    <span class="mr-3">
        {{ $icon ?? '' }}
    </span>
    {{ $slot }}
</a>