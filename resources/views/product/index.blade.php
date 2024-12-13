@php
    $count = 1;
@endphp

<x-layouts.app class="mt-6">
    <section class="flex justify-between">
        <div class="space-y-3 max-w-prose">
            <a href="{{ route('home') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
            <h1 class="text-5xl font-bold">{{ __('action.listings') }}</h1>
        </div>
        <div class="stats text-right">
            <div class="stat text-primary">
                <div class="stat-title">Products</div>
                <div class="stat-value">{{ $products->count('id') }}</div>
            </div>
            <div class="stat text-secondary">
                <div class="stat-title">Storage</div>
                <div class="stat-value">{{ $products->sum('stock') }}</div>
            </div>
        </div>
    </section>

    <section class="flex items-center justify-between">
        <div class="max-w-lg w-full">
            <x-forms.input name="search" icon="magnifying-glass" placeholder="Search product" :required="false" />
        </div>
        <a href="{{ route('new-product') }}" class="btn btn-primary">New product</a>
    </section>

    <section class="overflow-x-auto mt-4">
        <table class="table text-base">
            <thead class="text-sm">
                <tr class="uppercase">
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Qty.</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr class="group hover align-baseline">
                        <td class="w-16 text-center">
                            <span class="opacity-70 tabular-nums group-hover:hidden">{{ $count++ }}</span>
                            <span class="hidden group-hover:inline">
                                <button type="submit" form="delete-product-{{ $product->id }}">@svg('phosphor-x-bold', 'w-6 h-6')</button>
                                <x-layouts.form method="DELETE" action="{{ route('delete-product', $product->id) }}"
                                    id="delete-product-{{ $product->id }}" class="hidden" />
                            </span>
                        </td>
                        <td class="w-56">
                            <a href="{{ route('edit-product', $product->id) }}" class="link-hover">
                                <span class="group-hover:hidden">{{ $product->name }}</span>
                                <span class="hidden group-hover:inline font-bold">Edit</span>
                            </a>
                        </td>
                        <td class="tabular-nums">{{ $product->stock }}</td>
                        <td>{{ $product->price_fmt }}</td>
                        <td>{{ $product->category }}</td>
                        <td>
                            <img class="mask mask-squircle size-12 object-cover" src="{{ asset($product->image) }}"
                                alt="{{ $product->name }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</x-layouts.app>
