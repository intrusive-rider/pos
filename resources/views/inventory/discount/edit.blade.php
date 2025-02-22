<x-layouts.app class="space-y-8">
    <x-title>{{ __('Edit discount') }}</x-title>
    <x-layouts.form method="PATCH" action="{{ route('update-discount', $discount->id) }}" id="update-discount">
        <x-forms.input name="name" icon="seal-percent" value="{{ $discount->name }}" :placeholder="__('Name')" />

        <div class="flex items-center gap-4">
            <div class="w-full">
                <x-forms.select name="type" icon="square" class="select">
                    @slot('top_label')
                        Type
                    @endslot
                    <option value="perc" {{ old('type', $discount->type) === 'perc' ? 'selected' : '' }}>
                        {{ __('Percentage') }}
                    </option>
                    <option value="fixed" {{ old('type', $discount->type) === 'fixed' ? 'selected' : '' }}>
                        {{ __('Fixed') }}
                    </option>
                </x-forms.select>
            </div>
        </div>

        <x-forms.input name="value" type="number" icon="hash-straight" value="{{ $discount->value }}"
            :placeholder="__('Value')" class="no-spinner" />
        <x-forms.input name="max_value" type="number" icon="arrow-line-up" value="{{ $discount->max_value }}"
            :placeholder="__('Max. value (if in perc.)')" :required="false" class="no-spinner" />

        <x-forms.fieldset title="Availability">
            <x-forms.input name="start_date" type="date" icon="calendar-check" :placeholder="__('Start date')"
                value="{{ $discount->start_date ? $discount->start_date->format('Y-m-d') : '' }}" />
            <x-forms.input name="end_date" type="date" icon="calendar-x" :placeholder="__('End date')"
                value="{{ $discount->end_date ? $discount->end_date->format('Y-m-d') : '' }}" />
        </x-forms.fieldset>

        <div class="mt-6">
            <button type="submit" form="update-discount" class="btn btn-primary">{{ __('Update') }}</button>
            <a href="{{ route('index-discount') }}" class="btn btn-ghost">{{ __('form.cancel') }}</a>
        </div>
    </x-layouts.form>
</x-layouts.app>
