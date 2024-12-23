<div>
    <section class="flex items-center justify-between sticky py-3 top-0 z-10 backdrop-blur-sm">
        <div class="max-w-lg w-full">
            <x-forms.input name="search" icon="magnifying-glass" placeholder="Search product"
                wire:model.live.debounce.250ms="search" :required="false" />
        </div>
        <div class="flex items-center gap-x-2">
            <button class="btn btn-ghost" onclick="categories.showModal()">Categories</button>
            <a href="{{ route('new-product') }}" class="btn btn-primary">New product</a>
        </div>
    </section>

    <dialog id="categories" class="modal">
        <div class="modal-box max-w-[40rem] max-h-[50rem] p-0 pb-6">
            <div class="p-6 sticky top-0 z-10 bg-gradient-to-b from-base-100 to-transparent from-90%">
                <h2 class="text-xl font-semibold uppercase tracking-wide opacity-70">
                    {{ $categories->count() }}
                    {{ \Illuminate\Support\Str::plural('category', $categories->count()) }}
                </h2>
            </div>
            <div class="overflow-x-auto px-6">
                <table class="table text-base">
                    <thead class="text-sm">
                        <tr class="uppercase">
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Products</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="group hover align-baseline">
                                <td class="w-20 text-center">
                                    <span
                                        class="opacity-70 tabular-nums group-hover:hidden">{{ $loop->iteration }}</span>
                                    <span class="hidden group-hover:inline">
                                        <button class="btn btn-sm btn-ghost" type="submit"
                                            form="delete-category-{{ $category->id }}">
                                            @svg('phosphor-x-bold', 'w-5 h-5')</button>
                                        <x-layouts.form method="DELETE"
                                            action="{{ route('delete-category', $category->id) }}"
                                            id="delete-category-{{ $category->id }}" class="hidden" />
                                    </span>
                                </td>
                                <td class="w-56 h-16">
                                    <a href="{{ route('edit-category', $category->id) }}" class="link-hover">
                                        <span class="group-hover:hidden">{{ $category->name }}</span>
                                        <span class="hidden group-hover:inline font-bold">Edit</span>
                                    </a>
                                </td>
                                <td class="tabular-nums">{{ $category->products->count() }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>Close</button>
        </form>
    </dialog>

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
                @forelse ($this->filtered_products as $product)
                    <tr class="group hover align-baseline">
                        <td class="w-20 text-center">
                            <span class="opacity-70 tabular-nums group-hover:hidden">{{ $loop->iteration }}</span>
                            <span class="hidden group-hover:inline">
                                <button class="btn btn-sm btn-ghost" type="submit"
                                    form="delete-product-{{ $product->id }}">
                                    @svg('phosphor-x-bold', 'w-5 h-5')</button>
                                <x-layouts.form method="DELETE" action="{{ route('delete-product', $product->id) }}"
                                    id="delete-product-{{ $product->id }}" class="hidden" />
                            </span>
                        </td>
                        <td class="w-56">
                            <a href="{{ route('edit-product', $product->id) }}" class="link-hover">
                                <span class="group-hover:hidden">{{ $product->name }}</span>
                                <span class="hidden group-hover:inline font-bold">Edit</span>
                            </a>
                        </td>
                        <td class="tabular-nums">{{ $product->stock }}</td>
                        <td>{{ $product->price_fmt }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <img class="mask mask-squircle size-12 object-cover" src="{{ asset($product->image) }}"
                                alt="{{ $product->name }}">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center opacity-70">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>
