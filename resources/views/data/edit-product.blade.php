<x-layouts.app class="mt-6 pb-16">
    <h1 class="text-5xl font-bold">{{ __('Edit product') }}</h1>

    <x-layouts.form method="POST" action="{{ route('save-update', $product->id) }}" enctype="multipart/form-data">
        <x-forms.input name="name" icon="package" :placeholder="__('Name')" value="{{ $product->name }}" />
        <x-forms.input name="price" type="number" icon="tag" :placeholder="__('Price')" value="{{ $product->price }}" class="no-spinner" />
        <x-forms.input name="stock" type="number" icon="hash-straight" :placeholder="__('Stock')" value="{{ $product->stock }}" class="no-spinner" />
        <x-forms.select name="category" icon="square" :placeholder="__('Category')">
            <option {{ $product->category === 'Food' ? 'selected' : '' }} >Food</option>
            <option {{ $product->category === 'Drink' ? 'selected' : '' }} >Drink</option>
            <option {{ $product->category === 'Dessert' ? 'selected' : '' }} >Dessert</option>
        </x-forms.select>

        <x-forms.file-input name="image" accept="image/*" :required="false">
            @slot('top_label')
                Product image
            @endslot
        </x-forms.file-input>

        <div class="mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            <a href="/" class="btn btn-ghost">{{ __('form.cancel') }}</a>
        </div>
    </x-layouts.form>
</x-layouts.app>
