<nav class="navbar px-2 py-6 bg-base-100">
    <div class="navbar-start">
        <x-app-icon size="40" />
    </div>
    <div class="navbar-end">
        <button type="submit" form="logout" class="btn btn-ghost">Sign off</button>
        <x-layouts.form method="DELETE" action="/logout" class="hidden" id="logout" />
    </div>
</nav>
