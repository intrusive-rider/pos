<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layouts.import />

<body class="antialiased flex flex-col bg-base-100 min-h-screen mx-auto max-w-5xl px-10">
    <x-layouts.header />
    @livewireScripts
    <main {{ $attributes(['class' => 'space-y-8 w-full']) }}>
        {{ $slot }}
    </main>
</body>

</html>
