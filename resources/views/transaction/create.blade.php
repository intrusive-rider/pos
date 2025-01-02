<x-layouts.app class="mt-6" x-data="{ cartTotal: 0 }">
    <section class="space-y-3 max-w-prose mb-3">
        <a href="{{ route('home') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
        <h1 class="text-5xl font-bold">{{ __('title.create') }}</h1>
    </section>

    <x-layouts.form method="POST" action="{{ route('create-transaction') }}" id="checkout" class="max-w-none space-y-6">
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
            <div class="navbar-end">
                <button type="submit" form="checkout" class="btn btn-primary"
                    {{ $products->isEmpty() ? 'disabled' : '' }}>
                    {{ __('product.checkout') }}
                </button>
            </div>
        </section>

        @if (session('error'))
            <div role="alert" class="alert alert-error">
                @svg('phosphor-x-circle', 'w-6 h-6')
                <span>{{ session('error') }}</span>
            </div>
        @endif

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
            <p class="opacity-70">No product found. Add them here.</p>
        @endforelse
    </x-layouts.form>
</x-layouts.app>
