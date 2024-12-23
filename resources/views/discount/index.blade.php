<x-layouts.app class="mt-6">
    <section class="flex justify-between">
        <div class="space-y-3 max-w-prose">
            <a href="{{ route('home') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
            <h1 class="text-5xl font-bold">{{ __('Discounts') }}</h1>
        </div>
    </section>

    @livewire('discount-search', compact('discounts'))
</x-layouts.app>
