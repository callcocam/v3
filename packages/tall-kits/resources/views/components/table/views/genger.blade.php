@props(['model','column'])
<div class="flex items-center space-x-4 my-2">
    <div
        class="flex h-7 w-7 items-center rounded-lg bg-primary/10 p-2 text-primary dark:bg-accent-light/10 dark:text-accent-light">
        <x-tall-icon name="{{ data_get($model,$column->name) }}"  class="w-6 h-6"/>
    </div>
    <p>{{ __(data_get($model,$column->name)) }}</p>
</div>