<x-layouts.app class="space-y-8">
    <h1 class="text-5xl font-bold">{{ __('New Category') }}</h1>

    <x-layouts.form method="POST" action="{{ route('save-category') }}" enctype="multipart/form-data">
        <x-forms.input name="name" icon="hard-drives" :placeholder="__('Category')" />

        <div class="mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
            <a href="{{ route('index-category') }}" class="btn btn-ghost">{{ __('form.cancel') }}</a>
        </div>
    </x-layouts.form>
</x-layouts.app>
