<x-layouts.guest>
    @slot('left')
        <h1 class="text-5xl font-bold">Hello!</h1>
        <p class="text-xl">
            Nice to meet you! <br />
            To get started with your job, please register a new account. <br /><br />
            <a href="/login" class="link">Already registered?</a>
        </p>
    @endslot

    @slot('right')
        <x-layouts.form method="POST" action="/register">
            <x-forms.input name="name" icon="user" :placeholder="__('Your name')" />
            <x-forms.input name="email" type="email" icon="envelope" :placeholder="__('Email')" />
            <x-forms.input name="password" type="password" icon="key" :placeholder="__('Password')" />
            <x-forms.input name="password_confirmation" type="password" icon="key" :placeholder="__('Confirm password')" />

            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>

            <div class="divider"></div>

            <div class="space-y-4">
                <h1 class="text-2xl font-bold text-neutral">Already registered?</h1>
                <a href="/" class="btn btn-neutral btn-block">{{ __('Log in') }}</a>
            </div>
        </x-layouts.form>
    @endslot
</x-layouts.guest>
