@props([
    'title' => 'lorem',
    'price' => '10.000,00',
    'stock' => '1',
    'id' => 1,
])

@php
    $stockIsEmpty = $stock <= 0;
@endphp

<div class="card lg:card-side card-compact bg-base-100 shadow-xl ring-2 ring-base-200" x-data="{ count: 0, stock: {{ $stock }} }">
    <figure>
        <img src="https://placehold.co/400" />
    </figure>
    <div class="card-body justify-between w-full">
        <div class="space-y-3">
            <h2 class="card-title text-2xl {{ $stockIsEmpty ? 'line-through' : '' }}">{{ $title }}</h2>
            <p>
                <span x-text="stock">0</span> {{ __('product.stock_left') }} <br />
                {{ $price }}
            </p>
        </div>
        <div class="flex items-center join h-8">
            <div x-on:click="if (count > 0) { count--; stock++; }" class="btn btn-sm join-item" :disabled="count <= 0">
                @svg('phosphor-minus', 'w-4 h-4')
            </div>

            <input type="number" name="quantity[{{ $id }}]" x-model="count"
                x-on:input="stock = {{ $stock }} - count"
                class="border-none focus:ring-0 h-full join-item w-16 bg-base-200 tabular-nums slashed-zero flex items-center justify-center text-center no-spinner"
                :disabled="{{ $stockIsEmpty }}" />

            <div x-on:click="if (count < {{ $stock }}) { count++; stock--; }" class="btn btn-sm join-item"
                :disabled="count >= {{ $stock }}">
                @svg('phosphor-plus', 'w-4 h-4')
            </div>
        </div>
    </div>
</div>
