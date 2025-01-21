<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script>
    const snapToken = '{{ $snap_token }}';

    snap.pay(snapToken, {
        onSuccess: function(result) {
            console.log(result);
        },
        onPending: function(result) {
            console.log(result);
        },
        onError: function(result) {
            console.log(result);
        }
    });
</script>
