<x-layouts.app>
    <h1 class="text-5xl font-bold">{{ __('title.create') }}</h1>
    <section class="flex items-center justify-between sticky py-3 top-0 z-10 backdrop-blur-sm">
        <p>
            Go to:
            <a href="#Dessert">Dessert</a>
            <a href="#Food">Food</a>
            <a href="#Drinks">Drinks</a>
        </p>
        <div>
            <a href="/" class="btn btn-ghost">{{ __('form.cancel') }}</a>
            <button type="submit" form="checkout" class="btn btn-primary">{{ __('product.checkout') }}</button>
        </div>
    </section>

    @if (session('error'))
        <div role="alert" class="alert alert-error">
            @svg('phosphor-x-circle', 'w-6 h-6')
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <x-layouts.form method="POST" action="{{ route('create-transaction') }}" id="checkout"
        class="max-w-none space-y-6">
        @foreach ($products->groupBy('category') as $category => $products)
            <div class="space-y-3">
                <h2 class="text-lg font-semibold opacity-70 tracking-wider uppercase" id="{{ $category }}">{{ $category }}</h2>
                <div class="grid grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <x-cards.product-select :$product />
                    @endforeach
                </div>
            </div>
        @endforeach
    </x-layouts.form>
</x-layouts.app>
