<x-label fo="{{ $field->name }}">{{ __($field->label) }}:
    @if(\Illuminate\Support\Str::contains("required",$field->rules))
        <span class="text-danger">*</span>
    @endif
</x-label>
<div class="form-group" x-data="{}">
    <input wire:model="files" type="file" multiple>
    <x-input-help :message="$field->help"/>
    <x-input-error for="files"/>
</div>
