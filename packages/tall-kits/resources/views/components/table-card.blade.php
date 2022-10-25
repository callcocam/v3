@props(['model', 'columns'])
<div class="card">
    @if ($column = column('cover_photo_path', $columns))
        <x-dynamic-component component="{{ sprintf('tall-table.views.%s', $column->view) }}" :model="$model"
            :column="$column" />
    @endif
    <div class="flex grow flex-col px-4 pb-5 pt-1 text-center sm:px-5">
        @if ($columns)
            @foreach ($columns as $column)
                @if ($column->visible)
                    <x-dynamic-component component="{{ sprintf('tall-table.views.%s', $column->view) }}"
                        :model="$model" :column="$column" />
                @endif
            @endforeach
        @endif
        <div>
            <a href="{{ route('admin.post.edit', $model)}}"
                class="btn mt-4 rounded-full bg-primary font-medium text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:hover:shadow-accent/50 dark:focus:bg-accent-focus dark:focus:shadow-accent/50 dark:active:bg-accent/90">
                Read Article
            </a>
        </div>
    </div>
</div>
