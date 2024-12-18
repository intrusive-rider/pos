<x-layouts.app class="mt-6">
    <section class="flex justify-between">
        <div class="space-y-3 max-w-prose">
            <a href="{{ route('home') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
            <h1 class="text-5xl font-bold">{{ __('action.category') }}</h1>
        </div>
        
        <div class="stats text-right">
            <div class="stat text-primary">
                <div class="stat-title">Category</div>
                <div class="stat-value">{{ $categories->count() }}</div>
            </div>
        </div>
    </section>

    @livewire('category-search')
</x-layouts.app>
