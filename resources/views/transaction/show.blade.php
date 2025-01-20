<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex justify-between w-full">
        <x-layouts.form method="POST" action="{{ route('pay-transaction', $transaction->id) }}" class="space-y-3"
            id="pay-transaction" style="width: 22rem">
            <span
                class="text-lg uppercase tracking-wider opacity-70 tabular-nums slashed-zero">{{ 'TRS-' . sprintf('%03d', $transaction->id) }}</span>
            <label class="input input-lg flex items-center gap-2 p-0">
                <input type="text" name="buyer" id="buyer"
                    class="grow border-none focus:ring-0 text-5xl tracking-tight font-bold placeholder:opacity-70 p-0"
                    placeholder="{{ __('product.buyer') }}" value="{{ old('buyer') }}" required />
            </label>
            <x-forms.error :messages="$errors->get('buyer')" />
            <div class="divider"></div>
            <div class="flex gap-x-3">
                <div>
                    <div class="join mb-3">
                        <input type="hidden" name="payment_method" id="payment-method" value="cash">
                        <label for="amount" class="input input-bordered flex items-center gap-2 join-item">
                            <span class="opacity-70">Rp</span>
                            <input type="number" name="amount" id="amount"
                                class="grow border-none focus:ring-0 no-spinner w-32"
                                placeholder="{{ __('product.amount') }}" :value="{{ old('amount') }}" required />
                        </label>
                        <button type="submit"
                            class="btn btn-primary join-item">{{ __('product.pay') }}</button>
                    </div>
                    <x-forms.error :messages="$errors->get('amount')" />
                </div>
                
            </div>
            {{-- payment gateway midtrans --}}
            <button id="pay-button"
                class="btn btn-primary btn-block join-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="24" height="24" fill="currentColor">
                    <rect width="256" height="256" fill="none"></rect>
                    <rect x="40" y="72" width="176" height="112" rx="8" opacity="0.2"></rect>
                    <rect x="40" y="72" width="176" height="112" rx="8" stroke-width="16" stroke="currentColor" fill="none"></rect>
                    <line x1="40" y1="104" x2="216" y2="104" stroke-width="16" stroke="currentColor" fill="none"></line>
                    <line x1="152" y1="148" x2="176" y2="148" stroke-width="16" stroke="currentColor" fill="none"></line>
                </svg>
                <span class="ml-2">Pay with Card</span>
            </button>

            {{-- cancel --}}
            <button type="submit" form="delete-transaction"
                    class="btn btn-ghost btn-block join-item">{{ __('form.cancel') }}</button>
        </x-layouts.form>
        <div>
            <div class="space-y-3">
                @foreach ($transaction->products as $product)
                    <x-cards.product-list :$product />
                @endforeach
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">{{ __('Subtotal') }}:</h1>
                <span class="font-bold text-xl tabular-nums opacity-70">{{ $transaction->sub_total_fmt }}</span>
            </div>
            @if ($transaction->discounts)
                @foreach ($transaction->discounts as $discount)
                    <div class="flex justify-between">
                        <h1 class="text-lg">
                            {{ $discount->name }}:
                            @isset($discount->max_value)
                                <div class="text-sm opacity-70">(max. {{ $discount->max_value_fmt }})</div>
                            @endisset
                        </h1>
                        <span class="font-bold text-lg tabular-nums text-error">
                            -{{ $discount->value_fmt }}
                        </span>
                    </div>
                @endforeach
            @endif
            <div class="flex justify-between my-4">
                <h1 class="text-lg">{{ __('product.total') }}:</h1>
                <span class="font-bold text-3xl text-primary">{{ $transaction->grand_total_fmt }}</span>
            </div>
        </div>
    </div>
    <x-layouts.form class="hidden" method="DELETE" id="delete-transaction"
        action="{{ route('delete-transaction', $transaction->id) }}" />
</x-layouts.app>
