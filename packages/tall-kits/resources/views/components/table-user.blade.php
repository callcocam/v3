@props(['model', 'columns'])
<div class="card grow items-center p-4 sm:p-5">
    @if ($columns)
        @foreach ($columns as $column)
            <x-dynamic-component component="{{ sprintf('tall-table.views.%s', $column->view) }}" :model="$model"
                :column="$column" />
        @endforeach
    @endif

    <div class="flex justify-between items-center space-x-2">
        <a href="{{ route('admin.user.edit', $model) }}"
            class="btn mt-5 space-x-2 rounded-md bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
            <x-tall-icon name="user" class="h-4.5 w-4.5" />
            <span> {{ __('Edit') }} </span>
        </a>

        <a href="{{ route('admin.user.edit', $model) }}"
            class="btn mt-5 space-x-2 rounded-md bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
            <x-tall-icon name="trash" class="h-4.5 w-4.5" />
            <span> {{ __('Delete') }} </span>
        </a>
    </div>
</div>
