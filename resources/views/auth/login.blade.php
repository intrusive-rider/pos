<x-layouts.guest>
    <x-forms.auth-session-status class="mb-4" :status="session('status')" />

    @slot('left')
        <h1 class="text-5xl font-bold">Welcome!</h1>
        <p class="text-xl">
            It appears that you're not logged in. <br />
            Please log into your account to get started. <br/><br/>
            <a href="/register" class="link">New employee?</a>
        </p>
    @endslot

    @slot('right')
        <x-layouts.form method="POST" action="{{ route('login') }}">
            <x-forms.input name="email" type="email" icon="envelope" :placeholder="__('Email')" />
            <x-forms.input name="password" type="password" icon="key" :placeholder="__('Password')" />
            <x-forms.checkbox name="remember_me">{{ __('Remember me') }}</x-forms.checkbox>
            <button type="submit" class="mt-6 btn btn-primary btn-block">{{ __('Log in') }}</button>
        </x-layouts.form>
    @endslot
</x-layouts.guest>
