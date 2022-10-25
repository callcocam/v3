<fieldset>
    <x-mask-input-centimetros name="{{ $field->name }}">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">{{ __($field->label) }}
                    @if (\Illuminate\Support\Str::contains($field->rules, 'required'))
                        <span class="text-danger">*</span>
                    @endif
                </span>
            </div>
            <input onfocus="this.select();" id="{{ $field->name }}" class="{{ $field->class }}"
                x-ref="{{ $field->name }}"
                x-on:change="$dispatch('{{ $field->name }}', $refs.{{ $field->name }}.value)"
                wire:model.defer="{{ $field->key }}">
        </div>
        <x-input-help :message="$field->help" :link="$field->link" />
        <x-input-error :for="$field->key" />
    </x-mask-input-centimetros>
</fieldset>
