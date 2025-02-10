<x-layouts.app class="mt-6">
    <section class="flex justify-between">
        <div class="space-y-3 max-w-prose">
            <x-go-back href="{{ route('home') }}" />
            <x-title>{{ __('Discounts') }}</x-title>
        </div>
    </section>

    @livewire('discount-search', compact('discounts'))
</x-layouts.app>
