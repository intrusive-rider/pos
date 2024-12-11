<div class="space-y-6">
    <section class="flex items-center justify-between sticky top-0 z-10 backdrop-blur-sm">
        <div class="max-w-lg w-full">
            <x-forms.input name="search" icon="magnifying-glass" placeholder="Search invoice" wire:model.live="search" />
        </div>
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

    <x-layouts.form method="POST" action="{{ route('save-transaction') }}" id="checkout" class="pb-12 max-w-none">
        <div class="grid grid-cols-3 gap-6">
            @forelse ($this->products as $product)
                <x-cards.product-select title="{{ $product->name }}" price="{{ $product->price_fmt }}"
                    stock="{{ $product->stock }}" id="{{ $product->id }}" />
            @empty
                <span>No product found</span>
            @endforelse
        </div>
    </x-layouts.form>
</div>
