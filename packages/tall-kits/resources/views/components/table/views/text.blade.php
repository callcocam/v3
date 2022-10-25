@props(['model','column'])
<h3 class="pt-3 text-lg font-medium text-slate-700 dark:text-navy-100">
    {{ data_get($model,$column->name) }}
</h3>