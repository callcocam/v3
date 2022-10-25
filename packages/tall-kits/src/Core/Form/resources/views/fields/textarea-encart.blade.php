<x-label fo="{{ $field->name }}">{{ __($field->label) }}:
    @if (\Illuminate\Support\Str::contains('required', $field->rules))
        <span class="text-danger">*</span>
    @endif
</x-label>
<div class="form-group">
    <textarea wire:model{{ $field->wire_model }}="{{ $field->key }}" {!! $field->merge(['class' => $field->class, 'id' => $field->name]) !!}></textarea>
    <x-input-help :message="$field->help" />

    <x-input-error :for="$field->key" />
</div>
