@props([
    'title' => 'lorem',
    'price' => 10_000,
    'price_fmt' => 'Rp10.000,00',
    'qty' => 1,
])

@php
    $qty_price = $price * $qty
@endphp

<div class="card card-compact lg:card-side bg-base-100 shadow-xl ring-2 ring-base-200 w-[35rem]">
    <figure>
        <img src="https://placehold.co/100" />
    </figure>
    <div class="card-body flex-row items-center justify-between">
        <h2 class="card-title text-3xl">{{ $title }}</h2>

        <p class="text-lg text-right">
            {{ $price_fmt }} &times; {{ $qty }} <br />
            <span class="text-lg font-semibold">Rp{{ number_format($qty_price, 2, ',', '.') }}</span>
        </p>


    </div>
</div>