<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex justify-between w-full">
        <div class="space-y-6 w-80">
            <a href="{{ route('index-invoice') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
            <div class="space-y-3">
                <span class="text-lg uppercase tracking-wider opacity-70 block">{{ __('product.invoice') }}</span>
                <h1 class="text-5xl font-bold">{{ $transaction->buyer }}</h1>
                <div class="divider"></div>
                <div tabindex="0" class="collapse collapse-arrow border-2 border-base-200">
                    <div class="collapse-title text-lg uppercase tracking-wider opacity-70 block">Info</div>
                    <div class="collapse-content">
                        <p class="text-lg">
                            <span class="flex items-center gap-x-3"> @svg('phosphor-hash-bold', 'w-6 h-6') {{ $transaction->id }}</span>
                            <span class="flex items-center gap-x-3"> @svg('phosphor-cash-register-fill', 'w-6 h-6')
                                {{ $transaction->user->name }}</span>
                            <span class="flex items-center gap-x-3"> @svg('phosphor-calendar-check-fill', 'w-6 h-6')
                                {{ $transaction->created_at->format('d F Y, H.i') }} </span>
                    </div>
                </div>
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
                <h1 class="text-lg">{{ __('product.total') }}:</h1>
                <span class="font-bold text-2xl text-neutral tabular-nums">{{ $transaction->total_fmt }}</span>
            </div>
            <div class="flex justify-between">
                <h1 class="text-lg">{{ __('product.payment_amount') }}:</h1>
                <span class="font-bold text-2xl text-neutral tabular-nums">{{ $transaction->payment_amount_fmt }}</span>
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">{{ __('product.change') }}:</h1>
                <span
                    class="font-bold text-3xl text-primary tabular-nums">Rp{{ number_format($transaction->payment_amount - $transaction->total, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
</x-layouts.app>
