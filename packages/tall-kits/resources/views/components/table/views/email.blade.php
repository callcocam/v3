@props(['model','column'])
<div class="flex items-center space-x-4">
    <div
        class="flex h-7 w-7 items-center rounded-lg bg-primary/10 p-2 text-primary dark:bg-accent-light/10 dark:text-accent-light">
        <i class="fa fa-envelope text-xs"></i>
    </div>
    <p>{{ data_get($model,$column->name) }}</p>
</div>
