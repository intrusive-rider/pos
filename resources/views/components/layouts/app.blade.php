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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(".select").select2({
        allowClear: true,
        placeholder: 'Select or add option'
    });

    $(".select-create").select2({
        tags: true,
        allowClear: true,
        placeholder: 'Select or add option'
    });
</script>

</html>
