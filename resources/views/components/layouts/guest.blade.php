<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layouts.import />

<body class="h-screen flex bg-base-100">
    <aside class="w-3/5 bg-primary flex flex-col justify-between text-primary-content p-12 gap-6">
        <x-app-icon size="40" />
        <div class="max-w-prose space-y-4">
            {{ $left }}
        </div>
        <span></span>
    </aside>

    <main class="w-full flex flex-col justify-center p-24 gap-12">
        {{ $right }}
    </main>
</body>

</html>
