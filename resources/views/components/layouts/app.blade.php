<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layouts.import />

<body class="antialiased flex flex-col min-h-screen bg-base-100 px-48">
    @livewireScripts
    <x-layouts.header />
    <main {{ $attributes(['class' => 'space-y-8']) }}>
        {{ $slot }}
    </main>
</body>

</html>
