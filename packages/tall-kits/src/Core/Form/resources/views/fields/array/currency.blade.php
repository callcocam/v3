    <x-mask-input-medidas name="{{ $array_field->name }}">
        <x-label fo="{{ $array_field->name }}">{{ __($array_field->label) }}:
            @if ($array_field->rules)
                <span class="text-danger">*</span>
            @endif
        </x-label>
        <div class="form-group">
            <input x-ref="{{ $array_field->name }}" onfocus="this.select();" id="{{ $array_field->name }}" class="{{ $array_field->class }}"
                x-on:change="$dispatch('{{ $array_field->name }}', $refs.{{ $array_field->name }}.value)"
                wire:model.defer="{{ $array_field->key }}">
            <x-input-help :message="$array_field->help" />
            <x-input-error :for="$array_field->key" />
        </div>
    </x-mask-input-medidas>
