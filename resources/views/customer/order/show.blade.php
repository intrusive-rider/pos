<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex justify-between w-full">
        <x-layouts.form method="POST" action="{{ route('pay-order', $order->id) }}" class="space-y-3"
            id="pay-order" style="width: 22rem">
            <span
                class="text-lg uppercase tracking-wider opacity-70 tabular-nums slashed-zero">{{ 'TRS-' . sprintf('%03d', $order->id) }}</span>
            <label class="input input-lg flex items-center gap-2 p-0">
                <input type="text" name="buyer" id="buyer"
                    class="grow border-none focus:ring-0 text-5xl tracking-tight font-bold placeholder:opacity-70 p-0"
                    placeholder="{{ __('product.buyer') }}" value="{{ old('buyer') }}" required />
            </label>
            <x-forms.error :messages="$errors->get('buyer')" />
            <div class="divider"></div>
            <div class="flex gap-x-2">
                <button type="submit" form="pay-order"
                    class="btn btn-primary join-item">{{ __('Confirm payment') }}</button>
                <button type="submit" form="delete-order"
                    class="btn btn-ghost join-item">{{ __('form.cancel') }}</button>
            </div>
        </x-layouts.form>
        <div>
            <div class="space-y-3">
                @foreach ($order->products as $product)
                    <x-cards.product-list :$product />
                @endforeach
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">{{ __('Subtotal') }}:</h1>
                <span class="font-bold text-xl tabular-nums opacity-70">{{ $order->sub_total_fmt }}</span>
            </div>
            @if ($order->discounts)
                @foreach ($order->discounts as $discount)
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
                <span class="font-bold text-3xl text-primary">{{ $order->grand_total_fmt }}</span>
            </div>
        </div>
    </div>
    <x-layouts.form class="hidden" method="DELETE" id="delete-order"
        action="{{ route('delete-order', $order->id) }}" />
</x-layouts.app>
