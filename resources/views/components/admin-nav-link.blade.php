@props(['active' => false, 'href'])

<a href="{{ $href }}" @click="if (window.innerWidth < 1024) sidebarOpen = false" @class([
    'group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition duration-200',
    'bg-white text-emerald-950 shadow-lg shadow-emerald-950/10 ring-1 ring-emerald-100' => $active,
    'text-emerald-50/85 hover:bg-white/10 hover:text-white' => !$active,
])>
    <span @class([
        'grid h-10 w-10 place-items-center rounded-xl transition',
        'bg-emerald-100 text-emerald-700' => $active,
        'bg-white/10 text-emerald-100 group-hover:bg-emerald-300/20 group-hover:text-white' => !$active,
    ])>
        {{ $icon ?? '' }}
    </span>
    <span>{{ $slot }}</span>
</a>
