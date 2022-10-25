<fieldset>
    <label class="my-2" title="Click para copiar"> Descrição Completa >>>  <span class="text-danger font-bold">{{ $description_ERP }} </span><<< <a wire:click.prevent="copyERP" href="">Click para copiar</a></label>
    <div class="input-group">

        <div class="input-group-prepend">

            <span class="input-group-text">{{ __($field->label) }}
                @if(\Illuminate\Support\Str::contains("required",$field->rules))
                    <span class="text-danger">*</span>
                @endif
            </span>
        </div>
        <textarea  wire:model{{ $field->wire_model }}="{{ $field->key }}"  {!! $field->merge(['class'=>$field->class, 'id'=>$field->name]) !!}></textarea>
    </div>

    <x-input-help :message="$field->help"/>
    <x-input-error :for="$field->key"/>
</fieldset>
