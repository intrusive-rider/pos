<div>
    <section class="sticky py-3 top-0 z-10 backdrop-blur-sm">
        <div class="max-w-lg w-full">
            <x-forms.input name="search" icon="magnifying-glass" placeholder="Search discount"
                wire:model.live.debounce.250ms="search" :required="false" />
        </div>
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
                    <tr class="hover">
                        <td class="w-20 opacity-70 tabular-nums text-center">{{ $loop->iteration }}</td>
                        <td class="w-56 h-16">{{ $discount->name }}</td>
                        <td class="tabular-nums">{{ $discount->value_fmt }}</td>
                        <td>
                            {{ $discount->max_value ? $discount->max_value_fmt : 'None' }}
                        </td>
                        <td>{{ $discount->start_date->format('d M.') }} &mdash;
                            {{ $discount->end_date->format('d M.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center opacity-70">No discount found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>
