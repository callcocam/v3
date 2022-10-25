@props(['model', 'column'])
<div class="p-2">
    <img src="{{ data_get($model, $column->alias) }}" class="h-48 w-full rounded-lg object-cover object-center"
        alt="{{ data_get($model, $column->name) }}" />
</div>