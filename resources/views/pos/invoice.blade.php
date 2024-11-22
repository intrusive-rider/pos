<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex justify-between w-full">
        <div class="space-y-6">
            <a href="{{ route('home') }}" class="link link-hover text-lg">&larr; Go back</a>
            <div class="space-y-3">
                <span class="text-lg uppercase tracking-wider opacity-70 block">Invoice</span>
                <h1 class="text-5xl font-bold">{{ $transaction->buyer }}</h1>
                <div class="divider"></div>
                <span class="text-lg uppercase tracking-wider opacity-70 block">Info</span>
                <p class="text-lg">
                    <span class="flex items-center gap-x-3"> @svg('phosphor-cash-register-fill', 'w-6 h-6') {{ $transaction->user->name }}</span>
                    <span class="flex items-center gap-x-3"> @svg('phosphor-calendar-check-fill', 'w-6 h-6')
                        {{ $transaction->created_at->format('d F Y') }} </span>
                </p>
            </div>
        </div>
        <div>
            <div class="space-y-3">
                @foreach ($transaction->products as $product)
                    <x-cards.product-list title="{{ $product->name }}" price="{{ $product->price }}"
                        qty="{{ $product->pivot->quantity }}" />
                @endforeach
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">Grand total:</h1>
                <span class="font-bold text-2xl text-neutral tabular-nums">{{ $transaction->total_fmt }}</span>
            </div>
            <div class="flex justify-between">
                <h1 class="text-lg">Payment amount:</h1>
                <span class="font-bold text-2xl text-neutral tabular-nums">{{ $transaction->payment_amount_fmt }}</span>
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">Change:</h1>
                <span
                    class="font-bold text-3xl text-primary tabular-nums">Rp{{ number_format($transaction->payment_amount - $transaction->total, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
</x-layouts.app>
