@props(['model', 'column'])
@if (data_get($model, $column->name) == 'draft')
    <p
        class="tag rounded-full bg-secondary text-white hover:bg-secondary-focus focus:bg-secondary-focus active:bg-secondary-focus/90">
        {{ __(data_get($model, $column->name)) }}</p>
@else
    <p
        class="tag rounded-full bg-success text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
        {{ __(data_get($model, $column->name)) }}</p>
@endif
