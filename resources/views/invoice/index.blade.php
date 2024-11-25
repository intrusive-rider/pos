<x-layouts.app class="mt-6">
    <section class="space-y-6 max-w-prose">
        <a href="{{ route('home') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
        <h1 class="text-5xl font-bold">{{ __('action.invoices') }}</h1>
    </section>
    <div class="overflow-x-auto">
        <table class="table text-base">
            <thead class="text-sm">
                <tr>
                    <th></th>
                    <th>{{ __('product.buyer') }}</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $invoice)
                    <tr class="hover">
                        <td class="opacity-70 tabular-nums">{{ $invoice->id }}</td>
                        <td>
                            <a href="{{ route('show-invoice', $invoice->id) }}"
                                class="link link-hover">{{ $invoice->buyer }}</a>
                        </td>
                        <td>{{ $invoice->created_at->format('d F Y, H.i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
