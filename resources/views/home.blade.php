<x-layouts.app class="space-y-8">
    <section class="space-y-2">
        <x-title>{{ __('title.home', ['name' => Auth::user()->name]) }}</x-title>
        <div class="flex items-baseline justify-between">
            <p class="text-2xl">{{ __('title.home_sub') }}</p>
        </div>
    </section>
    <section class="grid grid-cols-2 gap-6">
        <x-cards.action href="{{ route('create-order') }}" icon="shopping-cart" class="bg-primary text-primary">
            <h1>{{ __('action.create') }}</h1>
        </x-cards.action>

        <x-cards.action href="{{ route('index-product') }}" icon="package" class="bg-secondary text-secondary-content">
            <h1>{{ __('action.listings') }}</h1>
        </x-cards.action>

        <x-cards.action href="{{ route('index-discount') }}" icon="seal-percent" class="bg-accent text-accent-content">
            <h1>{{ __('action.discount') }}</h1>
        </x-cards.action>

        <x-cards.action href="{{ route('index-invoice') }}" icon="scroll" class="bg-secondary text-secondary-content">
            <h1>{{ __('action.invoices') }}</h1>
        </x-cards.action>
    </section>
</x-layouts.app>
