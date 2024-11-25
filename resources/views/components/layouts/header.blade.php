<nav class="navbar px-2 py-6 bg-base-100">
    <div class="navbar-start space-x-3">
        <x-app-icon size="40" />
        <h1 class="text-3xl font-bold">POS</h1>
    </div>
    <div class="navbar-end">
        <button type="submit" form="logout" class="btn btn-ghost">{{ __('form.logout') }}</button>
        <x-layouts.form method="DELETE" action="{{ route('logout-user') }}" id="logout" class="hidden" />
    </div>
</nav>
