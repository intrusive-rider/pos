<x-layouts.app class="space-y-8">
    <x-title>{{ __('New discount') }}</x-title>
    <x-layouts.form method="POST" action="{{ route('store-discount') }}">
        <x-forms.input name="name" icon="seal-percent" :placeholder="__('Name')" />

        <div class="flex items-center gap-4">
            <div class="w-full">
                <x-forms.select name="type" icon="square" class="select">
                    @slot('top_label')
                        Type
                    @endslot
                    <option value="perc" {{ old('type') === 'perc' ? 'selected' : '' }}>
                        {{ __('Percentage') }}
                    </option>
                    <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>
                        {{ __('Fixed') }}
                    </option>
                </x-forms.select>
            </div>
        </div>

        <x-forms.input name="value" type="number" icon="hash-straight" :placeholder="__('Value')" class="no-spinner" />
        <x-forms.input name="max_value" type="number" icon="arrow-line-up" :placeholder="__('Max. value (if in perc.)')" :required="false"
            class="no-spinner" />

        <x-forms.fieldset title="Availability">
            <x-forms.input name="start_date" type="date" icon="calendar-check" :placeholder="__('Start date')" />
            <x-forms.input name="end_date" type="date" icon="calendar-x" :placeholder="__('End date')" />
        </x-forms.fieldset>

        <div class="mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
            <a href="{{ route('home') }}" class="btn btn-ghost">{{ __('form.cancel') }}</a>
        </div>
    </x-layouts.form>
</x-layouts.app>
