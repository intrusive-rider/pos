<nav class="navbar py-10 bg-base-100">
    <a href="{{ route('home') }}" class="navbar-start space-x-3">
        <x-app-icon size="40" />
        <h1 class="text-3xl font-bold">POS</h1>
    </a>
    <div class="navbar-end">
        <button type="submit" form="logout" class="btn btn-ghost">{{ __('form.logout') }}</button>
        <x-layouts.form method="DELETE" action="{{ route('logout-user') }}" id="logout" class="hidden" />
    </div>
</nav>
