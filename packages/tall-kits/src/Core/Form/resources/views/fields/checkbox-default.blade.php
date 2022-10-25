<input id="{{ $field->name }}" class="form-check-input mt-0 ms-2" type="checkbox" wire:model.defer="{{ $field->key }}">
<label for="{{ $field->name }}">{{ $field->label }}</label>
@error('form_data.fracionado')
    <span class="text-danger"> {{ $message }}</span>
@enderror
