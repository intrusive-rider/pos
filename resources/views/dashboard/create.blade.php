<x-layouts.app class="pb-16 space-y-6">
    <h1 class="text-5xl font-bold">New order</h1>
    <section class="flex items-center justify-between sticky top-0 z-10 backdrop-blur-sm">
        <x-layouts.form method="POST" action="/search">
            <x-forms.input name="q" icon="magnifying-glass" :placeholder="__('Search product')" />
        </x-layouts.form>
        <div>
            <a href="/" class="btn btn-ghost">Cancel</a>
            <a href="/" class="btn btn-primary">Check out</a>
        </div>
    </section>
    <section class="space-y-6 pb-12">
        <h2 class="text-3xl font-semibold">Popular items</h2>
        <div class="grid grid-cols-3 gap-6">
            <x-product title="Chair" />
            <x-product title="Paint" />
            <x-product title="Bed cover" />
            <x-product title="Screwdriver" />
            <x-product title="Plate" />
            <x-product title="Phone holder" />
        </div>
    </section>
    <section class="space-y-6 pb-12">
        <h2 class="text-3xl font-semibold">Bundles</h2>
        <div class="grid grid-cols-3 gap-6">
            <x-product title="Chair" />
            <x-product title="Paint" />
            <x-product title="Bed cover" />
            <x-product title="Screwdriver" />
            <x-product title="Plate" />
            <x-product title="Phone holder" />
        </div>
    </section>
    <section class="space-y-6 pb-12">
        <h2 class="text-3xl font-semibold">20&percnt; off</h2>
        <div class="grid grid-cols-3 gap-6">
            <x-product title="Chair" />
            <x-product title="Paint" />
            <x-product title="Bed cover" />
            <x-product title="Screwdriver" />
            <x-product title="Plate" />
            <x-product title="Phone holder" />
        </div>
    </section>
</x-layouts.app>
