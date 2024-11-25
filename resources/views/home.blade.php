<x-layouts.app class="mt-6">
    <section class="space-y-4 max-w-prose">
        <h1 class="text-5xl font-bold">{{ __('title.home', ['name' => Auth::user()->name]) }}</h1>
        <p class="text-2xl">{{ __('title.home_sub') }}</p>
    </section>
    <section class="grid grid-cols-3 gap-6">
        <x-cards.action href="{{ route('new-transaction') }}" icon="shopping-cart" class="bg-green-500">{{ __('action.create') }}</x-cards.action>
        <x-cards.action href="/" icon="package" class="bg-blue-500">{{ __('action.update') }}</x-cards.action>
        <x-cards.action href="/" icon="seal-percent" class="bg-pink-500">{{ __('action.discount', ['disc' => 20]) }}</x-cards.action>
        <x-cards.action href="https://example.com" icon="link" class="bg-amber-500">
            {{ __('action.website') }}
            <p class="font-normal text-xl">example.com</p>
        </x-cards.action>
        <x-cards.action href="/" icon="truck" class="bg-blue-500">{{ __('action.send') }}</x-cards.action>
        <x-cards.action href="/invoice" icon="scroll" class="bg-blue-500">{{ __('action.invoices') }}</x-cards.action>
    </section>
</x-layouts.app>
