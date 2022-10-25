<fieldset>
    <div class="input-group"">
        <div class="input-group-prepend">
            <span class="input-group-text">{{ __($field->label) }}
                @if(\Illuminate\Support\Str::contains("required",$field->rules))
                    <span class="text-danger">*</span>
                @endif
            </span>
        </div>
        <input  wire:model="file" type="file" class="form-control">

    </div>
    <x-input-error for="file"/>
    <x-input-error :for="$field->key"/>
    <x-input-help :message="$field->help"/>
</fieldset>
