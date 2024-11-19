<x-layouts.app class="pb-16">
    <h1 class="text-5xl font-bold">New order</h1>
    <section class="flex items-center justify-between sticky top-0 z-10 backdrop-blur-sm">
        <x-layouts.form method="POST" action="/search">
            <x-forms.input name="q" icon="magnifying-glass" :placeholder="__('Search product')" />
        </x-layouts.form>
        <div>
            <a href="/" class="btn btn-lg btn-ghost">Cancel</a>
            <a href="/" class="btn btn-lg btn-primary">Check out</a>
        </div>
    </section>
    <section class="space-y-6 pb-12">
        <h2 class="text-3xl font-semibold">Popular items</h2>
        <div class="grid grid-cols-3 gap-6">
            <x-product>Chair</x-product>
            <x-product>Paint</x-product>
            <x-product>Bed cover</x-product>
            <x-product>Screwdriver</x-product>
            <x-product>Plate</x-product>
            <x-product>Phone holder</x-product>
        </div>
    </section>
    <section class="space-y-6 pb-12">
        <h2 class="text-3xl font-semibold">Bundles</h2>
        <div class="grid grid-cols-3 gap-6">
            <x-product>Chair</x-product>
            <x-product>Paint</x-product>
            <x-product>Bed cover</x-product>
            <x-product>Screwdriver</x-product>
            <x-product>Plate</x-product>
            <x-product>Phone holder</x-product>
        </div>
    </section>
    <section class="space-y-6 pb-12">
        <h2 class="text-3xl font-semibold">Households</h2>
        <div class="grid grid-cols-3 gap-6">
            <x-product>Chair</x-product>
            <x-product>Paint</x-product>
            <x-product>Bed cover</x-product>
            <x-product>Screwdriver</x-product>
            <x-product>Plate</x-product>
            <x-product>Phone holder</x-product>
        </div>
    </section>
</x-layouts.app>
