<x-layouts.app class="mt-6">
    <section class="space-y-3 max-w-prose mb-3">
        <h1 class="text-5xl font-bold">{{ __('Edit order') }}</h1>
    </section>

    <x-layouts.form method="POST" action="{{ route('update-order', $order) }}" id="update-order"
        class="max-w-none space-y-6">
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
                                        value="{{ $discount->name }}" class="checkbox checkbox-primary"
                                        {{ $order->discounts->contains($discount->id) ? 'checked' : '' }} />
                                </div>
                            </div>
                        @empty
                            <div class="menu opacity-70">No discount found.</div>
                        @endforelse
                    </ul>
                </div>
                <button type="submit" form="update-order" class="btn btn-primary"
                    {{ $products->isEmpty() ? 'disabled' : '' }}>
                    {{ __('Save changes') }}
                </button>
            </div>
        </section>

        @if ($errors->has('quantity'))
            <div role="alert" class="alert alert-error">
                @svg('phosphor-x-circle', 'w-6 h-6')
                <span>{{ $errors->first('quantity') }}</span>
            </div>
        @endif

        @forelse ($products as $category => $product_list)
            <div class="space-y-3">
                <h2 class="text-lg font-semibold opacity-70 tracking-wider uppercase" id="{{ $category }}">
                    {{ $category }}</h2>
                <div class="grid grid-cols-3 gap-6">
                    @foreach ($product_list as $product)
                        <x-cards.product-select :$product :$order />
                    @endforeach
                </div>
            </div>
        @empty
            <p class="opacity-70">No product found. <a href="{{ route('create-product') }}">Add them here.</a></p>
        @endforelse
    </x-layouts.form>
</x-layouts.app>
