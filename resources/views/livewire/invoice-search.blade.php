@php
    $count = 1;
@endphp

<div>
    <section class="w-full sticky py-3 top-0 z-10 backdrop-blur-sm">
        <div class="max-w-lg">
            <x-forms.input name="search" icon="magnifying-glass" placeholder="Search invoice" wire:model.live="search" :required="false" />
        </div>
    </section>

    <section class="overflow-x-auto mt-4">
        <table class="table text-base">
            <thead class="text-sm">
                <tr class="uppercase">
                    <th>#</th>
                    <th>{{ __('product.buyer') }}</th>
                    <th>Payment total</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices as $invoice)
                    <tr class="hover">
                        <td class="opacity-70 tabular-nums">{{ $count++ }}</td>
                        <td>
                            <a href="{{ route('show-invoice', $invoice->id) }}"
                                class="link link-hover">{{ $invoice->buyer }}</a>
                        </td>
                        <td class="tabular-nums">{{ $invoice->total_fmt }}</td>
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
