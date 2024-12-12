@props(['product'])

@php
    $qty_price = $product->price * $product->pivot->quantity;
@endphp

<div class="card card-compact lg:card-side bg-base-100 shadow-xl ring-2 ring-base-200 w-[35rem]">
    <figure>
        <img src="{{ $product->image }}" class="w-24 object-cover" />
    </figure>
    <div class="card-body flex-row items-center justify-between">
        <h2 class="card-title text-3xl">{{ $product->name }}</h2>

        <p class="text-lg text-right">
            {{ $product->price_fmt }} &times; {{ $product->pivot->quantity }} <br />
            <span class="text-lg font-semibold">Rp{{ number_format($qty_price, 2, ',', '.') }}</span>
        </p>


    </div>
</div>
