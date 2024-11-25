<x-layouts.guest>
    <x-forms.auth-session-status class="mb-4" :status="session('status')" />

    @slot('left')
        <h1 class="text-5xl font-bold">{{ __('title.login') }}</h1>
        <p class="text-xl">
            {!! nl2br(__('title.login_sub')) !!} <br /><br />
            <a href="/register" class="link">{{ __('link.to_register') }}</a>
        </p>
    @endslot

    @slot('right')
        <x-layouts.form method="POST" action="{{ route('login-user') }}">
            <x-forms.input name="email" type="email" icon="envelope" :placeholder="__('form.email')" />
            <x-forms.input name="password" type="password" icon="key" :placeholder="__('form.password')" />
            <button type="submit" class="mt-6 btn btn-primary btn-block">{{ __('form.login') }}</button>
        </x-layouts.form>
    @endslot
</x-layouts.guest>
