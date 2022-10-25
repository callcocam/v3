<div class="form-check">
    <div class="custom-control custom-checkbox">
        <input  wire:model{{ $field->wire_model }}="{{ $field->key }}" {!! $field->merge(['class'=>"form-check-input form-check-primary"]) !!}
               name="{{$field->name}}" id="{{$field->name}}">
        <label class="form-check-label"
               for="{{$field->name}}">{{ $field->label }}</label>
    </div>
    
    <x-input-error :for="$field->key"/>
</div>






