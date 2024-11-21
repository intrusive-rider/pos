<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex justify-between w-full">
        <div class="space-y-3">
            <h1 class="text-5xl font-bold">Thank you, {{ $transaction->buyer }}</h1>
            <p class="text-2xl pb-3">You just bought these three items:</p>
            <a href="/" class="btn btn-ghost">Go back</a>
        </div>
        <div>
            <div class="space-y-3">
                @foreach ($transaction->products as $product)
                    <div class="card card-compact lg:card-side bg-base-100 shadow-xl ring-2 ring-black/10 w-[40rem]">
                        <figure>
                            <img src="https://placehold.co/100" />
                        </figure>
                        <div class="card-body flex-row items-center justify-between">
                            <h2 class="card-title text-3xl">{{ $product->name }}</h2>
                            <span class="text-lg leading-tight text-right">
                                {{ $product->pivot->quantity }} items <br />
                                <span>Rp{{ number_format($product->price * $product->pivot->quantity, 2, ',', '.') }}</span>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">Grand total:</h1>
                <span
                    class="font-bold text-2xl text-neutral">Rp{{ number_format($transaction->total, 2, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <h1 class="text-lg">Your payment amount:</h1>
                <span
                    class="font-bold text-2xl text-neutral">Rp{{ number_format($transaction->payment_amount, 2, ',', '.') }}</span>
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">Your change:</h1>
                <span
                    class="font-bold text-3xl text-primary">Rp{{ number_format($transaction->payment_amount - $transaction->total, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
</x-layouts.app>
