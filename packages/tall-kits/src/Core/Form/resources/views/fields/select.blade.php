<x-label fo="{{ $field->name }}">{{ __($field->label) }}:
    @if(\Illuminate\Support\Str::contains("required",$field->rules))
        <span class="text-danger">*</span>
    @endif
</x-label>
<div class="form-group">
    <select wire:model{{ $field->wire_model }}="{{ $field->key }}" {!! $field->merge(['class'=>$field->class, 'id'=>$field->name]) !!}>
        <option value="">=={{ __('Selecione') }}==</option>
        @if($field->options)
            @foreach($field->options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        @endif
    </select>
    <x-input-help :message="$field->help"/>
    <x-input-error :for="$field->key"/>
</div>
