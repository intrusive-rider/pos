<div>
    <section class="w-full sticky top-0 z-10 px-0 py-3 bg-gradient-to-b from-base-100 to-transparent from-90%">
        <div class="max-w-lg">
            <x-forms.input name="search" icon="magnifying-glass" placeholder="Search invoice" wire:model.live.debounce.250ms="search" :required="false" />
        </div>
    </section>

    <section class="overflow-x-auto mt-4">
        <table class="table text-base">
            <thead class="text-sm">
                <tr class="uppercase">
                    <th class="text-center">#</th>
                    <th>{{ __('product.buyer') }}</th>
                    <th>Grand total</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->filtered_invoices as $invoice)
                    <tr class="hover">
                        <td class="w-20 opacity-70 tabular-nums text-center">{{ $loop->iteration }}</td>
                        <td class="w-56 h-16">
                            <a href="{{ route('show-invoice', $invoice->id) }}"
                                class="link link-hover">{{ $invoice->buyer }}</a>
                        </td>
                        <td class="tabular-nums">{{ $invoice->grand_total_fmt }}</td>
                        <td>{{ $invoice->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center opacity-70">No invoices found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>
