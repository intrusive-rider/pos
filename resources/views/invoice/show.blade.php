<x-layouts.app class="flex items-center grow space-y-0">
    <div class="flex justify-between w-full">
        <div class="space-y-6 w-80">
            <a href="{{ route('index-invoice') }}" class="link link-hover text-lg">&larr; {{ __('link.go_back') }}</a>
            <div class="space-y-3">
                <span class="text-lg uppercase tracking-wider opacity-70 block">{{ __('product.invoice') }}</span>
                <h1 class="text-5xl font-bold">{{ $invoice->buyer }}</h1>
                <div class="divider"></div>
                <div tabindex="0" class="collapse collapse-arrow border-2 border-base-200">
                    <div class="collapse-title text-lg uppercase tracking-wider opacity-70 block">Info</div>
                    <div class="collapse-content">
                        <p class="text-lg">
                            <span class="flex items-center gap-x-3 tabular-nums slashed-zero"> @svg('phosphor-hash-bold', 'w-6 h-6')
                                TRS-{{ sprintf('%03d', $invoice->id) }}</span>
                            <span class="flex items-center gap-x-3"> @svg('phosphor-cash-register-fill', 'w-6 h-6')
                                {{ $invoice->user->name }}</span>
                            <span class="flex items-center gap-x-3"> @svg('phosphor-calendar-check-fill', 'w-6 h-6')
                                {{ $invoice->created_at->format('d M Y, H:i') }} </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="min-w-[30rem]">
            <button class="btn mb-4" onclick="products.showModal()">Details</button>
            @if ($invoice->discount)
                <div class="flex justify-between">
                    <h1 class="text-lg">{{ __('Subtotal') }}:</h1>
                    <span class="font-bold text-2xl text-neutral tabular-nums">{{ $invoice->total_before_fmt }}</span>
                </div>
                <div class="flex justify-between">
                    <h1 class="text-lg">{{ __('Discount') }}:</h1>
                    <span
                        class="font-bold text-2xl text-neutral tabular-nums">{{ $invoice->discount->value_fmt }}</span>
                </div>
            @endif
            <div class="flex justify-between">
                <h1 class="text-lg">{{ __('product.total') }}:</h1>
                <span class="font-bold text-2xl text-neutral tabular-nums">{{ $invoice->total_after_fmt }}</span>
            </div>
            <div class="flex justify-between">
                <h1 class="text-lg">{{ __('product.payment_amount') }}:</h1>
                <span class="font-bold text-2xl text-neutral tabular-nums">{{ $invoice->payment_amount_fmt }}</span>
            </div>
            <div class="divider"></div>
            <div class="flex justify-between">
                <h1 class="text-lg">{{ __('product.change') }}:</h1>
                <span
                    class="font-bold text-3xl text-primary tabular-nums">Rp{{ number_format($invoice->payment_amount - $invoice->total_after, 2, ',', '.') }}</span>
            </div>

            <button class="btn btn-primary btn-block mt-8" onclick="print_invoice()">Print</button>

            <div id="printed-content" class="hidden">
                <x-layouts.printed-invoice :$invoice />
            </div>
        </div>
    </div>

    <dialog id="products" class="modal">
        <div class="modal-box max-w-[40rem] max-h-[50rem] p-0 pb-6">
            <div class="p-6 sticky top-0 z-10 bg-gradient-to-b from-base-100 to-transparent from-90%">
                <h2 class="text-xl font-semibold uppercase tracking-wide opacity-70">
                    {{ $invoice->products->count() }}
                    {{ \Illuminate\Support\Str::plural('product', $invoice->products->count()) }}
                </h2>
            </div>
            <div class="space-y-3 px-6">
                @foreach ($invoice->products as $product)
                    <x-cards.product-list :$product />
                @endforeach
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>Close</button>
        </form>
    </dialog>

    <script>
        function print_invoice() {
            var content = document.getElementById("printed-content").innerHTML;

            var iframe = document.createElement("iframe");
            iframe.style.position = "absolute";
            iframe.style.width = "0px";
            iframe.style.height = "0px";
            iframe.style.border = "none";
            document.body.appendChild(iframe);

            var doc = iframe.contentDocument || iframe.contentWindow.document;

            doc.open();
            doc.write("<html><body>" + content + "</body></html>");
            doc.close();

            iframe.contentWindow.print();
            document.body.removeChild(iframe);
        }
    </script>
</x-layouts.app>
