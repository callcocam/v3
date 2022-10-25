{{--/**--}}
{{-- * Created by Claudio Campos.--}}
{{-- * User: callcocam@gmail.com, contato@sigasmart.com.br--}}
{{-- * https://www.sigasmart.com.br--}}
{{-- */--}}
<x-label fo="{{ $array_field->name }}">{{ __($array_field->label) }}:
    @if($array_field->rules)
        <span class="text-danger">*</span>
    @endif
</x-label>
<div class="form-group">
    <input   wire:model.{{ $array_field->wire_model }}="{{  $array_field->key }}"  {!! $array_field->merge(['class'=>$array_field->class, 'id'=>$array_field->name]) !!}>
    <x-input-help :message="$array_field->help"/>
    <x-input-error :for="$array_field->key"/>
</div>
