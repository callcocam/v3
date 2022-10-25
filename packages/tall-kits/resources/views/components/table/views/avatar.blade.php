@props(['model', 'column'])
<div class="avatar h-20 w-20">
    <img class="rounded-full " src="{{ data_get($model, $column->alias) }}" alt="{{ data_get($model, $column->name) }}" />
    <div
        class="absolute right-0 m-1 h-4 w-4 rounded-full border-2 border-white bg-primary dark:border-navy-700 dark:bg-accent">
    </div>
</div>
