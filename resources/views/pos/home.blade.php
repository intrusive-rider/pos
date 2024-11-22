<x-layouts.app class="mt-6">
    <section class="space-y-4 max-w-prose">
        <h1 class="text-5xl font-bold">Good day, {{ Auth::user()->name }}.</h1>
        <p class="text-2xl">What would you like to do?</p>
    </section>
    <section class="grid grid-cols-3 gap-6">
        <x-cards.action href="{{ route('new-transaction') }}" icon="shopping-cart" class="bg-green-500">New order</x-cards.action>
        <x-cards.action href="/" icon="package" class="bg-blue-500">Update stocks</x-cards.action>
        <x-cards.action href="/" icon="seal-percent" class="bg-pink-500">20% off</x-cards.action>
        <x-cards.action href="https://example.com" icon="link" class="bg-amber-500">
            Visit website
            <p class="font-normal text-xl">example.com</p>
        </x-cards.action>
        <x-cards.action href="/" icon="truck" class="bg-blue-500">Send to customer</x-cards.action>
        <x-cards.action href="/" icon="scroll" class="bg-blue-500">Report sales</x-cards.action>
    </section>
</x-layouts.app>
