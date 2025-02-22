<x-layouts.app class="mt-6">
    <section class="space-y-3 max-w-prose mb-3">
        <x-go-back href="{{ route('home') }}" />
        <x-title>{{ __('title.create') }}</x-title>
    </section>

    <x-layouts.form method="POST" action="{{ route('create-order') }}" id="checkout" class="max-w-none space-y-6">
        <section class="navbar sticky top-0 z-10 px-0 py-3 bg-gradient-to-b from-base-100 to-transparent from-90%">
            <div class="navbar-start">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-outline">Categories</div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                        @forelse ($products->keys() as $category)
                            <li><a href="#{{ $category }}">{{ $category }}</a></li>
                        @empty
                            <li class="opacity-70">No product found.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="navbar-end items-center gap-x-2">
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-circle btn-ghost">
                        @svg('phosphor-seal-percent', 'w-6 h-6')
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                        @forelse ($discounts as $discount)
                            <div class="menu">
                                <div class="flex justify-between">
                                    <div>
                                        <div class="font-bold text-base">{{ $discount->name }}</div>
                                        <div class="text-error text-xs">-{{ $discount->value_fmt }}</div>
                                    </div>
                                    <input type="checkbox" name="discount[{{ $discount->id }}]"
                                        value="{{ $discount->name }}" class="checkbox checkbox-primary" />
                                </div>
                            </div>
                        @empty
                            <div class="menu opacity-70">No discount found.</div>
                        @endforelse
                    </ul>
                </div>
                <button type="submit" form="checkout" class="btn btn-primary"
                    {{ $products->isEmpty() ? 'disabled' : '' }}>
                    {{ __('product.checkout') }}
                </button>
            </div>
        </section>

        <x-cards.error err_name="quantity" />

        @forelse ($products as $category => $products)
            <div class="space-y-3">
                <h2 class="text-lg font-semibold opacity-70 tracking-wider uppercase" id="{{ $category }}">
                    {{ $category }}</h2>
                <div class="grid grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <x-cards.product-select :$product />
                    @endforeach
                </div>
            </div>
        @empty
            <p class="opacity-70">No product found. <a href="{{ route('create-product') }}">Add them here.</a></p>
        @endforelse
    </x-layouts.form>
</x-layouts.app>
