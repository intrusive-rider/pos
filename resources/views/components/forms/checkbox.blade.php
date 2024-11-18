@props(['name' => ''])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
        'value' => old($name),
        'class' => 'checkbox checkbox-primary checkbox-md',
    ];
@endphp

<div class="form-control">
    <label class="label cursor-pointer justify-start gap-4">
        <input {{ $attributes($defaults) }}>
        <span class="label-text text-base">{{ $slot }}</span>
    </label>
</div>