<fieldset>
    <div class="input-group" x-data="{}">
        <div class="input-group-prepend">
            <span class="input-group-text">{{ __($field->label) }}
                @if (\Illuminate\Support\Str::contains('required', $field->rules))
                    <span class="text-danger">*</span>
                @endif
            </span>
        </div>
        <input
         wire:model{{ $field->wire_model }}="file.{{ $field->name }}"
            type="file" class="{{ $file ? 'form-control' : 'd-none' }}" x-ref="{{ $field->name }}">
            @if (!isset($file[$field->name]))
            <input wire:model.lazy="{{ $field->key }}" {!! $field->merge(['class' => $field->class]) !!}
                @click.prevent="$refs.{{ $field->name }}.click()">
        @endif

    </div>
    <x-input-error :for="$field->key" />
    <x-input-help :message="$field->help" />
</fieldset>
