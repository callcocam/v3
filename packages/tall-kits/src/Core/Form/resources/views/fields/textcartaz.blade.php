<input wire:model{{ $field->wire_model }}="{{ $field->key }}"  {!! $field->merge(['class'=>$field->class, 'id'=>$field->name]) !!}>
    <x-input-help :message="$field->help"/>
    <x-input-error :for="$field->key"/>
