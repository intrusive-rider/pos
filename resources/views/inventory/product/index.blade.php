<x-layouts.app class="mt-6">
    <section class="flex justify-between">
        <div class="space-y-3 max-w-prose">
            <x-go-back href="{{ route('home') }}" />
            <x-title>{{ __('action.listings') }}</x-title>
        </div>
        <div class="stats text-right">
            <div class="stat text-primary">
                <div class="stat-title">Products</div>
                <div class="stat-value">{{ $products->count('id') }}</div>
            </div>
            <div class="stat text-secondary">
                <div class="stat-title">Storage</div>
                <div class="stat-value">{{ $products->sum('stock') }}</div>
            </div>
        </div>
    </section>

    @livewire('product-search', compact('products', 'categories'))
</x-layouts.app>
