<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex justify-between w-full">
        <x-layouts.form method="POST" action="{{ route('pay-transaction', $transaction->id) }}" class="space-y-3">
            <span class="text-lg uppercase tracking-wider opacity-70">Transaction #{{ $transaction->id }}</span>
            <label class="input input-lg flex items-center gap-2 p-0">
                <input type="text" name="buyer" id="buyer"
                    class="grow border-none focus:ring-0 text-5xl font-bold placeholder:opacity-70 p-0"
                    placeholder="Buyer" value="{{ old('buyer') }}" required />
            </label>
            <div class="divider"></div>
            <div class="flex gap-x-3">
                <div>
                    <div class="join mb-3">
                        <label for="amount" class="input input-bordered flex items-center gap-2 join-item">
                            <span class="opacity-70">Rp</span>
                            <input type="number" name="amount" id="amount"
                                class="grow border-none focus:ring-0 no-spinner" placeholder="Amount"
                                :value="{{ old('amount') }}" required />
                        </label>
                        <button type="submit" class="btn btn-primary join-item">Pay</button>
                    </div>
                    <x-forms.error :messages="$errors->get('amount')" />
                </div>
                <button type="submit" form="delete-transaction" class="btn btn-ghost join-item">Abort</button>
            </div>
        </x-layouts.form>
        <div>
            <div class="space-y-3">
                @foreach ($transaction->products as $product)
                    <x-cards.product-list title="{{ $product->name }}" price="{{ $product->price }}" qty="{{ $product->pivot->quantity }}" />
                @endforeach
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">Grand total:</h1>
                <span
                    class="font-bold text-3xl text-primary">Rp{{ number_format($transaction->total, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
    <x-layouts.form class="hidden" method="DELETE" id="delete-transaction" action="{{ route('delete-transaction', $transaction->id) }}" />
</x-layouts.app>
