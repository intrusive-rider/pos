@props(['status'])

@if ($status)
    <div {{ $attributes(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif
