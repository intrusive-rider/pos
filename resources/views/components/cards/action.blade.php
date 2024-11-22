@props([
    'icon' => 'square',
])

@php
    $styles = [
        'flex flex-col justify-between',
        'hover:opacity-75',
        'p-8 h-64',
        'text-white text-4xl font-bold',
        'rounded-xl shadow-lg',
        'border-b-8 border-black/10',
        'transition-opacity',
    ];

    $styles = implode(' ', $styles);
@endphp

<a {{ $attributes(['class' => $styles]) }}>
    @svg('phosphor-' . $icon . '-fill', 'w-12 h-12 opacity-70')
    <div class="space-y-3">{{ $slot }}</div>
</a>
