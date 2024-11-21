@props(['messages'])

@if ($messages)
    <ul {{ $attributes(['class' => 'text-sm text-error space-y-2']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
