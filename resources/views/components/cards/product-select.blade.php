@props(['product'])

@php
    $stock_is_empty = $product->stock <= 0;
@endphp

<div class="card lg:card-side card-compact bg-base-100 shadow-xl ring-2 ring-base-200" x-data="{ count: 0, stock: {{ $product->stock }} }">
    <figure>
        <img src="{{ asset($product->image) }}" class="w-96 h-40 object-cover" />
    </figure>
    <div class="card-body justify-between w-full">
        <div class="space-y-3">
            <h2 class="card-title text-2xl {{ $stock_is_empty ? 'line-through' : '' }}">{{ $product->name }}</h2>
            <p>
                <span x-text="stock">0</span> {{ __('product.stock_left') }} <br />
                {{ $product->price_fmt }}
            </p>
        </div>
        <div class="flex items-center join h-8">
            <div x-on:click="if (count > 0) { count--; stock++; }" class="btn btn-sm join-item" :disabled="count <= 0">
                @svg('phosphor-minus', 'w-4 h-4')
            </div>

            <input type="number" name="quantity[{{ $product->id }}]" x-model="count"
                x-on:input="stock = {{ $product->stock }} - count"
                class="border-none focus:ring-0 h-full join-item w-16 bg-base-200 tabular-nums slashed-zero flex items-center justify-center text-center  disabled:opacity-70"
                :disabled="{{ $stock_is_empty }}" />

            <div x-on:click="if (count < {{ $product->stock }}) { count++; stock--; }" class="btn btn-sm join-item"
                :disabled="count >= {{ $product->stock }}">
                @svg('phosphor-plus', 'w-4 h-4')
            </div>
        </div>
    </div>
</div>
