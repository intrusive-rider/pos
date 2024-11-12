<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.home.head')
    @include('layouts.home.head-bottom-link')
</head>
@include('layouts.home.main')

<!-- [ Main Content ] start -->
<h3>aplikasi kasir</h3>
<!-- [ Main Content ] end -->
@include('layouts.home.footer')
<!-- Apex Chart -->
<script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>

{{-- @include('layouts.home.footer-bottom-link') --}}

<!-- custom-chart js -->
<script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script>
</body>

</html>
