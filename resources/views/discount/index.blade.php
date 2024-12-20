<x-layouts.app>
    <p>
        @foreach ($discounts as $discount)
            {{ $discount }}
        @endforeach
    </p>
</x-layouts.app>