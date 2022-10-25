<div>
    <label class="label label-primary my-2" for="inputGroupFile01"> {{ __($field->label) }}
        @if (\Illuminate\Support\Str::contains('required', $field->rules))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroup{{ $field->name }}"
            wire:model{{ $field->wire_model }}="{{ $field->key }}">
    </div>
    <x-input-help :message="$field->help" />
    <x-input-error :for="$field->key" />
</div>
