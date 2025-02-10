@props(['product'])

@php
    $qty_price = $product->price * $product->pivot->quantity;
@endphp

<div class="card card-compact lg:card-side bg-base-100 shadow-xl ring-2 ring-base-200 min-w-[30rem]">
    <figure>
        <img src="{{ asset($product->image) }}" class="size-24 object-cover" />
    </figure>
    <div class="card-body flex-row items-center justify-between">
        <h2 class="card-title text-3xl">{{ $product->name }}</h2>

        <p class="text-right">
            <span class="opacity-70 text-sm">{{ $product->price }} &times; {{ $product->pivot->quantity }}</span> <br />
            <span class="text-xl font-semibold">Rp{{ number_format($qty_price, 2, ',', '.') }}</span>
        </p>


    </div>
</div>
