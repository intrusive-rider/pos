<x-layouts.app class="space-y-8">
    <h1 class="text-5xl font-bold">{{ __('Edit product') }}</h1>

    <x-layouts.form method="PATCH" action="{{ route('update-product', $product->id) }}" enctype="multipart/form-data">
        <x-forms.input name="name" icon="package" :placeholder="__('Name')" value="{{ $product->name }}" />
        <x-forms.input name="price" type="number" icon="tag" :placeholder="__('Price')" value="{{ $product->price }}"
            class="no-spinner" />
        <x-forms.input name="stock" type="number" icon="hash-straight" :placeholder="__('Stock')"
            value="{{ $product->stock }}" class="no-spinner" />

        <x-forms.select class="select" name="category" icon="square" :placeholder="__('Category')">
            @foreach ($categories as $category)
                <option value="{{ $category->name }}"
                    {{ old('category', $product->category->name) === $category->name ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </x-forms.select>

        <x-forms.file-input name="image" accept="image/*" :required="false">
            @slot('top_label')
                Product image
            @endslot
        </x-forms.file-input>

        <div class="mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            <a href="{{ route('index-product') }}" class="btn btn-ghost">{{ __('form.cancel') }}</a>
        </div>
    </x-layouts.form>
</x-layouts.app>
