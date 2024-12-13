<x-layouts.app class="mt-6">
    <section class="flex justify-between">
        <div class="space-y-3 max-w-prose">
            <a href="{{ route('home') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
            <h1 class="text-5xl font-bold">{{ __('action.listings') }}</h1>
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

    @livewire('product-search')
</x-layouts.app>
