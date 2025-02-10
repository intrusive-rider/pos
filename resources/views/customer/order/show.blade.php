<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex-col grow space-y-12">
        <div class="flex items-baseline justify-between">
            <a href="#">Hello!</a>
            <x-title>Your order</x-title>
        </div>
        <div class="flex justify-between w-full">
            <x-layouts.form method="POST" action="{{ route('pay-order', $order->id) }}" class="space-y-3" id="pay-order"
                style="width: 24rem">
                <label class="input input-lg flex items-center gap-2 p-0">
                    <input type="text" name="buyer" id="buyer"
                        class="grow border-none focus:ring-0 text-5xl tracking-tight font-bold placeholder:opacity-70 p-0"
                        placeholder="{{ __('product.buyer') }}" value="{{ old('buyer') }}" required />
                </label>
                <x-forms.error :messages="$errors->get('buyer')" />
                <div class="divider"></div>
                <div>
                    <button type="submit" form="pay-order" class="btn btn-primary">{{ __('Confirm payment') }}</button>
                    <a href="{{ route('edit-order', $order) }}" class="btn btn-ghost">{{ __('Edit order') }}</a>
                </div>
                <x-cards.error err_name="payment" />
            </x-layouts.form>
            <div class="tracking-tight">
                <div class="space-y-3">
                    @foreach ($order->products as $product)
                        <x-cards.product-list :$product />
                    @endforeach
                </div>
                <div class="flex justify-between mt-8">
                    <h1 class="text-lg opacity-70">{{ __('Subtotal') }}:</h1>
                    <span class="font-semibold text-xl">{{ $order->sub_total_fmt }}</span>
                </div>
                @if ($order->discounts)
                    @foreach ($order->discounts as $discount)
                        <div class="flex justify-between">
                            <h1 class="text-lg opacity-70">
                                {{ $discount->name }}:
                                @isset($discount->max_value)
                                    <div class="text-sm opacity-70">(max. {{ $discount->max_value_fmt }})</div>
                                @endisset
                            </h1>
                            <span class="font-semibold text-xl text-error">
                                -{{ $discount->value_fmt }}
                            </span>
                        </div>
                    @endforeach
                @endif
                <div class="divider"></div>
                <div class="flex justify-between">
                    <h1 class="text-lg opacity-70">{{ __('product.total') }}:</h1>
                    <span class="font-bold text-3xl text-primary">{{ $order->grand_total_fmt }}</span>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
