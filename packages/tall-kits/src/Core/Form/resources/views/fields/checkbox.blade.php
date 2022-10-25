@isset($search_checkbox)
    <div class="row">
        <div class="col mb-2">
            <input wire:model.debounce.500ms="search_checkbox.{{ $field->name }}" type="search" class="form-control"
                placeholder="Buscar...">
        </div>
        @isset($search_extras)
            @if (is_array($search_extras))
                <div class="col mb-2">
                    <input wire:model.debounce.500ms="search_checkbox.{{ data_get($search_extras, 'field') }}" type="search"
                        class="form-control" placeholder="{{ data_get($search_extras, 'placeholder') }}...">
                </div>
            @else
                <div class="col mb-2">
                    <input wire:model.debounce.500ms="search_checkbox.{{ $search_extras }}" type="search" class="form-control"
                        placeholder="Buscar...">
                </div>
            @endif
        @endisset
    </div>
@endisset
<ul class="list-unstyled mb-0 mt-4" @if ($field->sort) wire:sortable="updateOrder" @endif>
    @if ($field->options)
        @foreach ($field->options as $key => $value)
            <li class="d-block mb-1 w-full cursor-move"
                @if ($field->sort) wire:sortable.item="{{ $key }}" @endif
                wire:key="task-{{ $key }}">
                <div class="form-check">
                    <div class="custom-control custom-checkbox">
                        <input wire:model{{ $field->wire_model }}="{{ $field->key }}.{{ $key }}"
                            {!! $field->merge(['class' => 'form-check-input form-check-primary pl-2']) !!} name="customCheck" id="{{ $key }}">
                        <label wire:sortable.handle @if ($field->sort) style="cursor: move" @endif
                            class="form-check-label mr-2 {{ isset($search_checkbox[$field->name]) && $search_checkbox[$field->name] && strchr(Str::upper($value), Str::upper($search_checkbox[$field->name])) ? ' text-danger' : '' }}"
                            for="{{ $key }}">{{ $value }}</label>
                    </div>
                </div>
            </li>
        @endforeach
    @else
        <li class="d-inline-block mb-1 w-25 ">Use o campo de busca para pesquisar</li>
    @endif
</ul>
