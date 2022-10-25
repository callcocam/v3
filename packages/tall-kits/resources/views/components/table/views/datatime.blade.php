@props(['model','column'])
<div class="flex items-center space-x-2">
    <div
        class="flex h-7 w-7 items-center rounded-lg bg-primary/10 p-2 text-primary dark:bg-accent-light/10 dark:text-accent-light">
        <i class="fa fa-calendar text-xs"></i>
    </div>
    <p class="text-xs">{{ date_carbom_format(data_get($model,$column->name))->format('d/m/Y H:i:s') }}</p>
</div>
