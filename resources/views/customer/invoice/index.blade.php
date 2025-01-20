<x-layouts.app>
    <section class="flex justify-between">
        <div class="space-y-3 max-w-prose">
            <a href="{{ route('home') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
            <h1 class="text-5xl font-bold">{{ __('action.invoices') }}</h1>
        </div>
        <div class="stats text-right">
            <div class="stat text-primary">
                <div class="stat-title">Total</div>
                <div class="stat-value">Rp{{ number_format($invoices->sum('grand_total'), 2, ',', '.') }}</div>
            </div>
    
            <div class="stat text-secondary">
                <div class="stat-title">Orders</div>
                <div class="stat-value">{{ $invoices->count('id') }}</div>
            </div>
        </div>
    </section>

    @livewire('invoice-search', compact('invoices'))
</x-layouts.app>
