<search>
    <section
        class="flex items-baseline justify-between sticky top-0 z-10 px-0 py-3 bg-gradient-to-b from-base-100 to-transparent from-90%">
        <div class="max-w-lg w-full">
            <x-forms.input name="search" icon="magnifying-glass" placeholder="Search discount"
                wire:model.live.debounce.250ms="search" :required="false" />
        </div>
        <a href="{{ route('create-discount') }}" class="btn btn-primary">New discount</a>
    </section>

    <section class="overflow-x-auto mt-4">
        <table class="table text-base">
            <thead class="text-sm">
                <tr class="uppercase">
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Max.</th>
                    <th>Available in</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->filtered_discounts as $discount)
                    <tr class="group hover align-baseline h-16">
                        <td class="w-20 text-center">
                            <span class="opacity-70 tabular-nums group-hover:hidden">{{ $loop->iteration }}</span>
                            <span class="hidden group-hover:inline">
                                <button class="btn btn-sm btn-ghost" type="submit"
                                    form="delete-discount-{{ $discount->id }}">
                                    @svg('phosphor-trash-bold', 'w-5 h-5 text-error')</button>
                                <x-layouts.form method="DELETE" action="{{ route('delete-discount', $discount->id) }}"
                                    id="delete-discount-{{ $discount->id }}" class="hidden" />
                            </span>
                        </td>
                        <td class="w-56">
                            <a href="{{ route('edit-discount', $discount->id) }}" class="link-hover">
                                <span class="group-hover:hidden">{{ $discount->name }}</span>
                                <span class="hidden group-hover:inline font-bold">Edit</span>
                            </a>
                        </td>
                        <td class="tracking-tight">-{{ $discount->value_fmt }}</td>
                        <td>
                            {{ $discount->max_value ? $discount->max_value_fmt : 'None' }}
                        </td>
                        <td>{{ $discount->start_date->format('d M') }} &ndash;
                            {{ $discount->end_date->format('d M') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center opacity-70">No discount found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</search>
