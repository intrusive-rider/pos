<x-layouts.app class="flex gap-x-12">
    <div class="space-y-6">
        <section class="space-y-4 max-w-prose">
            <h1 class="text-5xl font-bold">Good day, {{ Auth::user()->name }}.</h1>
            <p class="text-4xl">What would you like to do?</p>
        </section>
        <section class="grid grid-cols-3 gap-6">
            <x-card href="/create" icon="shopping-cart" color="green">New order</x-card>
            <x-card href="/" icon="package">Update stocks</x-card>
            <x-card href="/" icon="seal-percent" color="pink">20% off</x-card>
            <x-card href="https://example.com" icon="link" color="amber">
                Visit website
                <p class="font-normal text-xl">example.com</p>
            </x-card>
            <x-card href="/" icon="truck">Send to customer</x-card>
            <x-card href="/" icon="scroll">Report sales</x-card>
        </section>
    </div>
    <section
        class="flex flex-col items-center text-center justify-center w-2/5 space-y-4 border-2 border-black/10 text-gray-500 p-6 rounded-xl">
        <h1 class="text-4xl font-bold">No order placed.</h1>
        <p class="text-lg">When you create an order, it would appear here.</p>
    </section>
</x-layouts.app>
