@php
    $count = 1;
@endphp

<div>
    <section class="flex items-center justify-between sticky py-3 top-0 z-10 backdrop-blur-sm">
        <div class="max-w-lg w-full">
            <x-forms.input name="search" icon="magnifying-glass" placeholder="Search discount"
                wire:model.live.debounce.250ms="search" :required="false" />
        </div>
        <a href="{{ route('new-discount') }}" class="btn btn-primary">New discount</a>
    </section>

    <section class="overflow-x-auto mt-4">
        <table class="table text-base">
            <thead class="text-sm">
                <tr class="uppercase">
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Qty.</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                    <tr class="group hover align-baseline">
                        <td class="w-20 text-center">
                            <span class="opacity-70 tabular-nums group-hover:hidden">{{ $count++ }}</span>
                            <span class="hidden group-hover:inline">
                                <button class="btn btn-sm btn-ghost" type="submit"
                                    form="delete-product-">
                                    @svg('phosphor-x-bold', 'w-5 h-5')</button>
                                <x-layouts.form method="DELETE" action="/"
                                    id="delete-product-" class="hidden" />
                            </span>
                        </td>
                        <td class="w-56">
                            <a href="/" class="link-hover">
                                <span class="group-hover:hidden">sjfjshd</span>
                                <span class="hidden group-hover:inline font-bold">Edit</span>
                            </a>
                        </td>
                        <td class="tabular-nums">jkjie</td>
                        <td>jjeihf</td>
                        <td>jshfjhsd</td>
                        <td>
                            {{-- <img class="mask mask-squircle size-12 object-cover" src="{{ asset($product->image) }}"
                                alt="{{ $product->name }}"> --}}
                            image
                        </td>
                    </tr>
                {{-- @empty
                    <tr>
                        <td colspan="6" class="text-center opacity-70">No products found.</td>
                    </tr>
                @endforelse --}}
            </tbody>
        </table>
    </section>
</div>
