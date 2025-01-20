<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-layouts.import />

<body class="antialiased flex flex-col bg-base-100 min-h-screen mx-auto max-w-5xl px-10">
    <x-layouts.header />
    @livewireScripts
    <main {{ $attributes(['class' => 'w-full pb-14 mt-6']) }}>
        {{ $slot }}
    </main>

    {{-- snap midtrans --}}
    
    {{-- <script>
        document.getElementById('pay-button').addEventListener('click', function (event) {
            event.preventDefault();
            // Set payment method to midtrans
            document.getElementById('payment-method').value = 'midtrans';
    
            // Call Midtrans payment popup
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    // Handle successful payment
                    console.log(result);
                    alert('Payment successful!');
                    document.getElementById('pay-transaction').submit();
                },
                onPending: function(result) {
                    // Handle pending payment
                    console.log(result);
                    alert('Payment is pending.');
                },
                onError: function(result) {
                    // Handle failed payment
                    console.error(result);
                    alert('Payment failed!');
                }
            });
        });
    </script> --}}
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(".select").select2({
        allowClear: true,
        placeholder: 'Select an option'
    });
    
    $(".select-create").select2({
        tags: true,
        allowClear: true,
        placeholder: 'Select or add option'
    });
</script>

</html>
