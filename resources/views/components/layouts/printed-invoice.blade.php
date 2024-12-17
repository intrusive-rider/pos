@props(['invoice'])

<div id="wrapper">
    <x-app-icon size="60" />
    <div id="content">
        <section id="header">
            <h1>Receipt</h1>
            <h1>{{ sprintf('%03d', $invoice->id) }}</h1>
        </section>
        <section>
            <p id="left">
                @foreach ($invoice->products as $product)
                    {{ $product->pivot->quantity }} &times; {{ $product->name }} <br />
                @endforeach
            </p>
            <p id="right">
                @foreach ($invoice->products as $product)
                    Rp{{ number_format($product->pivot->quantity * $product->price, 2, ',', '.') }}<br />
                @endforeach
            </p>
        </section>
        <hr />
        <section>
            <p id="left">
                Total <br />
                Payment amount <br />
                Change
            </p>
            <p id="right">
                {{ $invoice->total_fmt }} <br />
                {{ $invoice->payment_amount_fmt }} <br />
                Rp{{ number_format($invoice->payment_amount - $invoice->total, 2, ',', '.') }}
            </p>
        </section>
        <hr />
        <footer>
            <p id="left">
                Buyer <br />
                Placed
            </p>
            <p id="right">
                {{ $invoice->buyer }}<br />
                {{ $invoice->created_at->format('d M Y, H:i') }}
            </p>
        </footer>
    </div>
</div>
<style>
    #wrapper {
        width: 28rem;
        font-family: monospace;
        font-size: 1.5rem;
        text-transform: uppercase;
        margin: 3rem;
    }

    #content {
        margin-top: 2rem;
    }

    h1,
    p {
        margin: 0;
    }

    #left {
        font-weight: 700;
    }

    #right {
        text-align: right;
    }

    section,
    footer {
        display: flex;
        justify-content: space-between;
        padding-block: 1rem;
    }

    #header {
        background-color: black;
        color: white;
        margin-bottom: 1rem;
        padding-block: unset;
    }

    footer {
        font-size: 1rem;
        opacity: 0.6;
    }
</style>
