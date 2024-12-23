<x-layouts.app class="space-y-8">
    <section class="space-y-4 max-w-prose">
        <h1 class="text-5xl font-bold">{{ __('title.home', ['name' => Auth::user()->name]) }}</h1>
        <p class="text-2xl">{{ __('title.home_sub') }}</p>
    </section>
    <section class="grid grid-cols-2 gap-6">
        <x-cards.action href="{{ route('create-transaction') }}" icon="shopping-cart"
            class="bg-green-500">{{ __('action.create') }}</x-cards.action>
            
        <x-cards.action href="{{ route('index-product') }}" icon="package"
            class="bg-amber-500">{{ __('action.listings') }}</x-cards.action>

        <x-cards.action href="{{ route('index-discount') }}" icon="seal-percent"
            class="bg-pink-500">{{ __('Discounts') }}</x-cards.action>

        <x-cards.action href="{{ route('index-invoice') }}" icon="scroll"
            class="bg-blue-500">{{ __('action.invoices') }}</x-cards.action>
    </section>
</x-layouts.app>
