@props([
    'name',
    'label' => null,
    'placeholder' => '', 
    'icon', 
    'required' => true,])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'grow',
        'required' => $required,
    ];
@endphp

<div class="form-control my-3">
    @isset($top_label)
        <div class="label opacity-50 font-medium">
            {{ $top_label }}
        </div>
    @endisset
    <label for="{{ $name }}" class="input input-bordered flex items-center gap-2">
        @isset($icon)
            @svg('phosphor-' . $icon, 'w-6 h-6 opacity-70')
        @endisset
        <select {{ $attributes($defaults) }}>
            {{ $slot }}
        </select>
    </label>
    @if (isset($bottom_label) || $errors->isNotEmpty())
        <div class="label">
            {{ $bottom_label ?? '' }}
            <div></div>
            <x-forms.error :messages="$errors->get($name)" />
        </div>
    @endif
</div>
