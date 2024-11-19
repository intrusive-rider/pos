@props([
    'title' => 'Lorem',
    'price' => '10.000,00'
])

<div class="card lg:card-side card-compact bg-base-100 shadow-xl">
    <figure>
        <img src="https://placehold.co/400" />
    </figure>
    <div class="card-body justify-between w-56">
        <h2 class="card-title text-2xl">{{ $title }}</h2>
        <p>Rp{{ $price }}</p>
        <x-counter />
    </div>
</div>
