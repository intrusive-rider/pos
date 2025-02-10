@props(['err_name'])

@if ($errors->has($err_name))
    <div role="alert" class="alert alert-error items-start">
        @svg('phosphor-x-circle', 'w-6 h-6')
        <span>{{ $errors->first($err_name) }}</span>
    </div>
@endif