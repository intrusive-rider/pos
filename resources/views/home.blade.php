<x-layouts.app class="space-y-8">
    <section class="space-y-2">
        <h1 class="text-5xl font-bold">{{ __('title.home', ['name' => Auth::user()->name]) }}</h1>
        <div class="flex items-baseline justify-between">
            <p class="text-2xl">{{ __('title.home_sub') }}</p>
            <a href="{{ route('index-discount') }}" class="btn btn-ghost">Past discounts</a> <!-- TODO: Rapihin ini -->
        </div>
    </section>
    <section class="grid grid-cols-2 gap-6">
        <x-cards.action href="{{ route('create-transaction') }}" icon="shopping-cart" class="bg-primary text-primary">
            <h1>{{ __('action.create') }}</h1>
        </x-cards.action>

        <x-cards.action href="{{ route('index-product') }}" icon="package" class="bg-secondary text-secondary-content">
            <h1>{{ __('action.listings') }}</h1>
        </x-cards.action>

        @empty($discount)
            <x-cards.action href="{{ route('new-discount') }}" icon="seal-percent" class="bg-accent text-accent-content">
                <h1>{{ __('action.discount') }}</h1>
            </x-cards.action>
        @else
            <x-cards.action href="{{ route('edit-discount', $discount->id) }}" icon="seal-percent" class="bg-accent text-accent-content">
                <div class="flex items-baseline justify-between">
                    <div class="space-y-2">
                        <h1>{{ $discount->name }}</h1>
                        <div class="text-lg opacity-70">{{ $discount->start_date->format('d M.') }} &mdash;
                            {{ $discount->end_date->format('d M.') }}</div>
                    </div>
                    <div class="badge badge-lg badge-outline">{{ $discount->value_fmt }}</div>
                </div>
            </x-cards.action>
        @endempty

        <x-cards.action href="{{ route('index-invoice') }}" icon="scroll" class="bg-secondary text-secondary-content">
            <h1>{{ __('action.invoices') }}</h1>
        </x-cards.action>
    </section>
</x-layouts.app>
