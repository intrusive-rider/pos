<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex justify-between w-full">
        <div class="space-y-3">
            <h1 class="text-5xl font-bold">{{ $transaction->buyer }}</h1>
            <p class="text-2xl pb-3">bought these three items:</p>
            <a href="{{ route('home') }}" class="btn btn-ghost">Go back</a>
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
                <span
                    class="font-bold text-2xl text-neutral tabular-nums">Rp{{ number_format($transaction->total, 2, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <h1 class="text-lg">Your payment amount:</h1>
                <span
                    class="font-bold text-2xl text-neutral tabular-nums">Rp{{ number_format($transaction->payment_amount, 2, ',', '.') }}</span>
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">Your change:</h1>
                <span
                    class="font-bold text-3xl text-primary tabular-nums">Rp{{ number_format($transaction->payment_amount - $transaction->total, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
</x-layouts.app>
