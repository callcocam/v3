<x-label fo="{{ $field->name }}">{{ __($field->label) }}:
    @if(\Illuminate\Support\Str::contains("required",$field->rules))
        <span class="text-danger">*</span>
    @endif
</x-label>
<div>
    <textarea fs-codehighlight-element="code" id="codearea" style="min-height: 500px" wire:model{{ $field->wire_model }}="{{ $field->key }}"  {!! $field->merge(['class'=>$field->class, 'id'=>$field->name]) !!}></textarea>
    <x-input-help :message="$field->help"/>
    <x-input-error :for="$field->key"/>
</div>
<!-- [Attributes by Finsweet] Code Highlight -->
<script async src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-codehighlight@1/codehighlight.js"></script>
<style>
    #codearea{
        background: #333;
        color: #fff;
    }
</style>
