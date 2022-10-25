<fieldset>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">{{ __($field->label) }}
                @if(\Illuminate\Support\Str::contains($field->rules,"required"))
                    <span class="text-danger">*</span>
                @endif
            </span>
        </div>
        <input wire:model{{ $field->wire_model }}="{{ $field->key }}"  {!! $field->merge(['class'=>$field->class, 'id'=>$field->name]) !!}>
    </div>

    <x-input-help :message="$field->help" :link="$field->link"/>
    <x-input-error :for="$field->key"/>
</fieldset>
