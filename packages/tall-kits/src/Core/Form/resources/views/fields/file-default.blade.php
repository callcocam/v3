<x-label fo="{{ $field->name }}">{{ __($field->label) }}:
    @if(\Illuminate\Support\Str::contains("required",$field->rules))
        <span class="text-danger">*</span>
    @endif
</x-label>
<div class="form-group" x-data="{}">
    <input wire:model{{ $field->wire_model }}="{{ $field->key }}"  type="file" id="{{$field->name}}" ref="{{$field->name}}">
    <x-input-help :message="$field->help"/>
    <x-input-error :for="$field->key"/>
</div>
