<x-layouts.app class="space-y-8">
    <h1 class="text-5xl font-bold">{{ __('Edit product') }}</h1>

    <x-layouts.form method="PATCH" action="{{ route('update-product', $product->id) }}" enctype="multipart/form-data">
        <x-forms.input name="name" icon="package" :placeholder="__('Name')" value="{{ $product->name }}" />
        <x-forms.input name="price" type="number" icon="tag" :placeholder="__('Price')" value="{{ $product->price }}"
            class="no-spinner" />
        <x-forms.input name="stock" type="number" icon="hash-straight" :placeholder="__('Stock')"
            value="{{ $product->stock }}" class="no-spinner" />

        <div class="flex items-center gap-4">
            <div class="w-full">
                <x-forms.select class="select-create" name="category" icon="square">
                    @slot('top_label')
                        Category
                    @endslot
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}"
                            {{ old('category', $product->category->name) === $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-forms.select>

                @if ($product->image)
                    <div>
                        <label class="label opacity-70 font-medium">
                            Product image
                        </label>
                        <div class="flex items-center gap-4">
                            <!-- image preview -->
                            <img id="image-preview" src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                class="mask mask-squircle w-24 h-24 object-cover">

                            <!-- replace button and hidden file input -->
                            <div>
                                <button type="button" class="btn btn-ghost"
                                    onclick="document.getElementById('file-input').click();">
                                    Replace
                                </button>
                                <input type="file" id="file-input" name="image" accept="image/*" class="hidden"
                                    onchange="updateImagePreview(event);">
                            </div>
                        </div>
                    </div>

                    <script>
                        function updateImagePreview(event) {
                            const file = event.target.files[0];
                            const preview = document.getElementById('image-preview');

                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    preview.src = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        }
                    </script>
                @else
                    <x-forms.file-input name="image" accept="image/*" :required="false">
                        @slot('top_label')
                            Product image
                        @endslot
                    </x-forms.file-input>
                @endif

                <div class="mt-6">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    <a href="{{ route('index-product') }}" class="btn btn-ghost">{{ __('form.cancel') }}</a>
                </div>
            </div>
        </div>
    </x-layouts.form>
</x-layouts.app>
