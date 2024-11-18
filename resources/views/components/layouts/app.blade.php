<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layouts.import />

<body class="antialiased flex flex-col h-screen bg-base-100 px-48 pb-16 space-y-6">
    <x-layouts.header />
    <main {{ $attributes(['class' => 'grow']) }}>
        {{ $slot }}
    </main>
</body>

</html>
