@props([
    'name' => '',
    'label' => null,
    'icon',
])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'grow border-none focus:ring-0',
        'value' => old($name),
        'required' => 'required',
    ];
@endphp

<div class="form-control my-3">
    @isset($top_label)
        <div class="label">
            {{ $top_label }}
        </div>
    @endisset
    <label for="{{ $name }}" class="input input-bordered flex items-center gap-2">
        @isset($icon)
            @svg('phosphor-' . $icon, 'w-6 h-6 opacity-70')
        @endisset
        <input {{ $attributes($defaults) }} />
    </label>
    @if (isset($bottom_label) || $errors->isNotEmpty())
        <div class="label">
            {{ $bottom_label ?? '' }}
            <div></div>
            <x-forms.error :messages="$errors->get($name)" />
        </div>
    @endif
</div>
