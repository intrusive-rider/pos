<x-layouts.app>
    <section class="flex justify-between">
        <div class="space-y-3 max-w-prose">
            <x-go-back href="{{ route('home') }}" />
            <x-title>{{ __('action.invoices') }}</x-title>
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
