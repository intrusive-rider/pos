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

<div class="form-control">
    <div class="label">
        @isset($top_label)
            {{ $top_label }}
        @endisset
    </div>
    <label for="{{ $name }}" class="input input-bordered flex items-center gap-2">
        @isset($icon)
            <i class="ph ph-{{ $icon }} text-xl opacity-70"></i>
        @endisset
        <input {{ $attributes($defaults) }} />
    </label>
    <div class="label">
        @isset($bottom_label)
            {{ $bottom_label }}
        @endisset
        <div></div>
        <x-forms.error :messages="$errors->get($name)" />
    </div>
</div>
