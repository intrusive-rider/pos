<x-layouts.guest>
    <x-forms.auth-session-status class="mb-4" :status="session('status')" />

    @slot('left')
        <h1 class="text-5xl font-bold">Welcome back!</h1>
        <p>Log into your Acme account to shop right away.</p>
    @endslot

    @slot('right')
        <x-layouts.form method="POST" action="{{ route('login') }}">
            <x-forms.input name="email" type="email" icon="envelope" :placeholder="__('Email')" />
            <x-forms.input name="password" type="password" icon="key" :placeholder="__('Password')">
                @slot('label')
                    <a class="link link-hover text-sm font-semibold opacity-70 block" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endslot
            </x-forms.input>
            <x-forms.checkbox name="remember_me">{{ __('Remember me') }}</x-forms.checkbox>
            <button type="submit" class="btn btn-primary btn-block">{{ __('Log in') }}</button>
            <div class="divider"></div>
            <div class="space-y-4">
                <h1 class="text-2xl font-bold text-neutral">Don't have an account?</h1>
                <div class="grid grid-cols-2 gap-4">
                    <a href="/register" class="btn btn-neutral btn-block">Register</a>
                    <a href="/register" class="btn btn-ghost btn-block">For employee</a>
                </div>
            </div>
        </x-layouts.form>
    @endslot
</x-layouts.guest>
