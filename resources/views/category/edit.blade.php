<x-layouts.app class="space-y-8">
    <h1 class="text-5xl font-bold">{{ __('Edit Category') }}</h1>

    <x-layouts.form method="PATCH" action="{{ route('update-category', $category->id) }}" enctype="multipart/form-data">
        <x-forms.input name="name" icon="hard-drives" :placeholder="__('Category')" value="{{ $category->name }}"  />

        <div class="mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            <a href="{{ route('index-category') }}" class="btn btn-ghost">{{ __('form.cancel') }}</a>
        </div>
    </x-layouts.form>
</x-layouts.app>
