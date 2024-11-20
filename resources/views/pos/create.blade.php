<x-layouts.app class="pb-16 space-y-6">
    <h1 class="text-5xl font-bold">New order</h1>
    <section class="flex items-center justify-between sticky top-0 z-10 backdrop-blur-sm">
        <x-layouts.form method="POST" action="/search">
            <x-forms.input name="q" icon="magnifying-glass" :placeholder="__('Search product')" />
        </x-layouts.form>
        <div>
            <a href="/" class="btn btn-ghost">Cancel</a>
            <button type="submit" form="checkout" class="btn btn-primary">Check out</button>
        </div>
    </section>
    <x-layouts.form method="POST" action="/new" id="checkout" class="pb-12 max-w-none">
        <div class="grid grid-cols-3 gap-6">
            @foreach ($products as $product)
                <x-product title="{{ $product->name }}"
                    price="{{ number_format($product->price, 2, ',', '.') }}"
                    stock="{{ $product->stock }}" id="{{ $product->id }}" />
            @endforeach
        </div>
    </x-layouts.form>
</x-layouts.app>
