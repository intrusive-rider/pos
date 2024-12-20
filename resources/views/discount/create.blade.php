<x-layouts.app class="space-y-8">
    <h1 class="text-5xl font-bold">{{ __('New Discount') }}</h1>

    <x-layouts.form method="POST" action="/" enctype="multipart/form-data">
        <!-- Diskon Name -->
        <x-forms.input name="name" icon="percent" :placeholder="__('Discount Name')" />

        <!-- Diskon Type -->
        <x-forms.select name="type" icon="list" :placeholder="__('Discount Type')">
            <option value="percentage">{{ __('Percentage (%)') }}</option>
            <option value="amount">{{ __('Fixed Amount') }}</option>
        </x-forms.select>

        <!-- Diskon Amount -->
        <x-forms.input name="value" type="number" icon="tag" :placeholder="__('Discount Value')" class="no-spinner" />

        <!-- Valid From -->
        <x-forms.input name="valid_from" type="date" icon="calendar" :placeholder="__('Valid From')" />

        <!-- Valid To -->
        <x-forms.input name="valid_to" type="date" icon="calendar" :placeholder="__('Valid To')" />

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
            <a href="{{ route('index-discount') }}" class="btn btn-ghost">{{ __('form.cancel') }}</a>
        </div>
    </x-layouts.form>
</x-layouts.app>
