<label class="w-100" title="Click para selecionar um imagem" style="cursor: pointer" for="{{ $field->name }}">{{ __($field->label) }}:
    @if (\Illuminate\Support\Str::contains('required', $field->rules))
        <span class="text-danger">*</span>
    @endif
    <input hidden wire:model{{ $field->wire_model }}="file.{{ $field->name }}" type="file" id="{{ $field->name }}"
        ref="{{ $field->name }}">
    <input wire:model{{ $field->wire_model }}="{{ $field->key }}" type="hidden">
    @isset($file[$field->name])
        <img class="d-flex w-100" src="{{ $file[$field->name]->temporaryUrl() }}">
    @else
        @isset($form_data[$field->name])
            <img class="d-flex w-100 " src="{{ \Storage::url($form_data[$field->name]) }}" alt="{{ \Storage::url($form_data[$field->name]) }}">
        @else
            <img class="d-flex w-100" src="https://dummyimage.com/1200x724/edeef7/1d29cf?text={{ __($field->label) }}">
        @endisset
    @endisset
    <x-input-help :message="$field->help" />
    <x-input-error :for="$field->key" />
</label>
