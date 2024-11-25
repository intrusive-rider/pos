<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex justify-between w-full">
        <x-layouts.form method="POST" action="{{ route('pay-transaction', $transaction->id) }}" class="space-y-3">
            <span class="text-lg uppercase tracking-wider opacity-70">{{ __('product.transaction') . ' #' . $transaction->id }}</span>
            <label class="input input-lg flex items-center gap-2 p-0">
                <input type="text" name="buyer" id="buyer"
                    class="grow border-none focus:ring-0 text-5xl font-bold placeholder:opacity-70 p-0"
                    placeholder="{{ __('product.buyer') }}" value="{{ old('buyer') }}" required />
            </label>
            <x-forms.error :messages="$errors->get('buyer')" />
            <div class="divider"></div>
            <div class="flex gap-x-3">
                <div>
                    <div class="join mb-3">
                        <label for="amount" class="input input-bordered flex items-center gap-2 join-item">
                            <span class="opacity-70">Rp</span>
                            <input type="number" name="amount" id="amount"
                                class="grow border-none focus:ring-0 no-spinner" placeholder="{{ __('product.amount') }}"
                                :value="{{ old('amount') }}" required />
                        </label>
                        <button type="submit" class="btn btn-primary join-item">{{ __('product.pay') }}</button>
                    </div>
                    <x-forms.error :messages="$errors->get('amount')" />
                </div>
                <button type="submit" form="delete-transaction" class="btn btn-ghost join-item">{{ __('form.cancel') }}</button>
            </div>
        </x-layouts.form>
        <div>
            <div class="space-y-3">
                @foreach ($transaction->products as $product)
                    <x-cards.product-list title="{{ $product->name }}" price="{{ $product->price }}" price_fmt="{{ $product->price_fmt }}" qty="{{ $product->pivot->quantity }}" />
                @endforeach
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">{{ __('product.total') }}:</h1>
                <span
                    class="font-bold text-3xl text-primary">{{ $transaction->total_fmt }}</span>
            </div>
        </div>
    </div>
    <x-layouts.form class="hidden" method="DELETE" id="delete-transaction" action="{{ route('delete-transaction', $transaction->id) }}" />
</x-layouts.app>
