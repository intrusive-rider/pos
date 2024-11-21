@props([
    'icon' => 'square',
    'color' => 'blue',
])

@php
    $styles = [
        'flex flex-col justify-between',
        'bg-'.$color.'-500',
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
    <i class="ph-fill ph-{{ $icon }} text-5xl opacity-75"></i>
    <div class="space-y-3">{{ $slot }}</div>
</a>
