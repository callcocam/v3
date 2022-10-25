<input wire:model{{ $field->wire_model }}="{{ $field->key }}" type="hidden"  {!! $field->merge(['class'=>$field->class, 'id'=>$field->name]) !!}>
