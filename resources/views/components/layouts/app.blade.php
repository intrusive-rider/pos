<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layouts.import />

<body class="antialiased flex flex-col bg-base-100 min-h-screen mx-auto max-w-5xl px-10">
    <x-layouts.header />
    @livewireScripts
    <main {{ $attributes(['class' => 'w-full pb-14 mt-6']) }}>
        {{ $slot }}
    </main>
</body>

</html>
