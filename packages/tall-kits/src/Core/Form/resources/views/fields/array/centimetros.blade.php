<x-mask-input-centimetros name="{{ str_replace('.', '_', $array_field->key) }}">
    <x-label fo="{{ str_replace('.', '_', $array_field->key) }}">{{ __($array_field->label) }}:
        @if ($array_field->rules)
            <span class="text-danger">*</span>
        @endif
    </x-label>
    <div class="form-group">
        <input x-ref="{{ str_replace('.', '_', $array_field->key) }}" onfocus="this.select();"
            id="{{ str_replace('.', '_', $array_field->key) }}" class="{{ $array_field->class }}"
            x-on:change="$dispatch('{{ str_replace('.', '_', $array_field->key) }}', $refs.{{ str_replace('.', '_', $array_field->key) }}.value)"
            wire:model.defer="{{ $array_field->key }}">
        <x-input-help :message="$array_field->help" />
        <x-input-error :for="$array_field->key" />
    </div>
</x-mask-input-centimetros>
