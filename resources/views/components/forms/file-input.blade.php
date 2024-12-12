@props([
    'name' => '',
    'label' => null,
    'required' => true,
])

@php
    $defaults = [
        'type' => 'file',
        'id' => $name,
        'name' => $name,
        'class' => 'file-input file-input-bordered w-full',
        'value' => old($name),
        'required' => $required,
    ];
@endphp

<div class="form-control my-3">
    @isset($top_label)
        <div class="label">
            {{ $top_label }}
        </div>
    @endisset
    <input {{ $attributes($defaults) }} />
    @if (isset($bottom_label) || $errors->isNotEmpty())
        <div class="label">
            {{ $bottom_label ?? '' }}
            <div></div>
            <x-forms.error :messages="$errors->get($name)" />
        </div>
    @endif
</div>