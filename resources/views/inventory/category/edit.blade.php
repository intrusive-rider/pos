<x-layouts.app class="space-y-8">
    <x-title>{{ __('Edit category') }}</x-title>

    <x-layouts.form method="PATCH" action="{{ route('update-category', $category->id) }}">
        <x-forms.input name="name" icon="tag" :placeholder="__('Name')" value="{{ $category->name }}" />

        <div class="mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            <a href="{{ route('index-product') }}" class="btn btn-ghost">{{ __('form.cancel') }}</a>
        </div>
    </x-layouts.form>
</x-layouts.app>
