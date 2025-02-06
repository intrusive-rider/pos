@props(['icon', 'title', 'grid' => true])

@php
    $styles = ['border border-base-300 rounded-xl px-5 py-2', 'grid grid-cols-2 gap-x-3' => $grid];
@endphp

<fieldset @class($styles)>
    <legend class="flex gap-x-2">
        @isset($icon)
            @svg('phosphor-' . $icon, 'w-6 h-6 opacity-70')
        @endisset
        <span class="opacity-50">{{ $title }}</span>
    </legend>
    {{ $slot }}
</fieldset>