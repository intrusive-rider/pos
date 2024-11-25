<x-layouts.guest>
    @slot('left')
        <h1 class="text-5xl font-bold">{{ __('title.register') }}</h1>
        <p class="text-xl">
            {!! nl2br(__('title.reg_sub')) !!}<br /><br />
            <a href="/login" class="link">{{ __('link.to_login') }}</a>
        </p>
    @endslot

    @slot('right')
        <x-layouts.form method="POST" action="{{ route('register-user') }}">
            <x-forms.input name="name" icon="user" :placeholder="__('form.username')" />
            <x-forms.input name="email" type="email" icon="envelope" :placeholder="__('form.email')" />
            <x-forms.input name="password" type="password" icon="key" :placeholder="__('form.password')" />
            <x-forms.input name="password_confirmation" type="password" icon="key" :placeholder="__('form.confirm_password')" />
            <button type="submit" class="mt-6 btn btn-primary btn-block">{{ __('form.register') }}</button>
        </x-layouts.form>
    @endslot
</x-layouts.guest>
