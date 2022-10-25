<x-label fo="{{ $field->name }}">{{ __($field->label) }}:
    @if($field->rules)
    <span class="text-danger">*</span>
    @endif
</x-label>
<div class="form-group">
{{--    <input wire:model{{ $field->wire_model }}="{{ $field->key }}"  {!! $field->merge(['class'=>$field->class, 'id'=>$field->name]) !!}>--}}


    <input wire:model{{ $field->wire_model }}="{{ $field->key }}" type="color" id="favcolor" name="favcolor" value="#ccc">
    <x-input-help :message="$field->help"/>
    <x-input-error :for="$field->key"/>

</div>
