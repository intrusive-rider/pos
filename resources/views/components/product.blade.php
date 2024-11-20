@props([
    'title' => 'Lorem',
    'price' => '10.000,00',
    'stock' => '1',
])

<div class="card lg:card-side card-compact bg-base-100 shadow-xl" x-data="{ count: 0, stock: {{ $stock }} }">
    <figure>x
        <img src="https://placehold.co/400" />
    </figure>
    <div class="card-body justify-between w-72">
        <h2 class="card-title text-2xl">{{ $title }}</h2>
        <p>
            Rp{{ $price }} <br />
            <span x-text="stock">0</span> left
        </p>
        <div class="flex items-center join h-8">
            <button x-on:click="if (count > 0) { count--; stock++; }" class="btn btn-sm join-item" :disabled="count <= 0">
                <i class="ph-bold ph-minus"></i>
            </button>

            <input type="number" x-model="count" x-on:input="stock = {{ $stock }} - count"
                class="border-none focus:ring-0 h-full join-item w-16 bg-base-200 tabular-nums slashed-zero flex items-center justify-center text-center no-spinner" />
                
            <button x-on:click="if (count < {{ $stock }}) { count++; stock--; }" class="btn btn-sm join-item"
                :disabled="count >= {{ $stock }}">
                <i class="ph-bold ph-plus"></i>
            </button>
        </div>
    </div>
</div>
