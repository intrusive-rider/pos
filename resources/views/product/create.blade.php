<x-layouts.app class="space-y-8">
    <h1 class="text-5xl font-bold">{{ __('New product') }}</h1>

    <x-layouts.form method="POST" action="{{ route('save-product') }}" enctype="multipart/form-data">
        <x-forms.input name="name" icon="package" :placeholder="__('Name')" />
        <x-forms.input name="price" type="number" icon="tag" :placeholder="__('Price')" class="no-spinner" />
        <x-forms.input name="stock" type="number" icon="hash-straight" :placeholder="__('Stock')" class="no-spinner" />

        <x-forms.select class="select" name="category" icon="square" :placeholder="__('Category')">
            @foreach ($categories as $category)
                <option value="{{ $category->name }}" 
                    {{ old('category') === $category->name ? 'selected' : '' }}>
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
            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
            <a href="{{ route('index-product') }}" class="btn btn-ghost">{{ __('form.cancel') }}</a>
        </div>
    </x-layouts.form>
</x-layouts.app>
