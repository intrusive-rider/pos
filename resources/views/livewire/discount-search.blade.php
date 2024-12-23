<div>
    <section class="flex items-center justify-between sticky py-3 top-0 z-10 backdrop-blur-sm">
        <div class="max-w-lg w-full">
            <x-forms.input name="search" icon="magnifying-glass" placeholder="Search discount"
                wire:model.live.debounce.250ms="search" :required="false" />
        </div>
        <a href="{{ route('new-discount') }}" class="btn btn-primary">New discount</a>
    </section>

    <section class="grid grid-cols-3 gap-4 mt-1">
        @forelse ($this->filtered_discounts as $discount)
            <a href="{{ route('edit-discount', $discount->id) }}"
                class="card card-compact bg-base-100 shadow-xl ring-2 ring-base-200 hover:bg-base-200 transition-colors">
                <div class="card-body justify-center">
                    <div class="flex items-baseline justify-between">
                        <h2 class="card-title text-2xl">{{ $discount->name }}</h2>
                        <span class="text-red-500 font-medium text-lg">-{{ $discount->value_fmt }}</span>
                    </div>
                    <div class="font-medium tracking-wide opacity-70 text-sm flex justify-between">
                        <p>{{ $discount->start_date->format('d M') }}&mdash;{{ $discount->end_date->format('d M') }}</p>
                        @if ($discount->max_value)
                            <p class="flex items-center justify-end gap-x-1">
                                @svg('phosphor-arrow-line-up', 'w-4 h-4')
                                {{ $discount->max_value_fmt }}
                            </p>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <p class="opacity-70">No discount found.</p>
        @endforelse
    </section>
</div>
