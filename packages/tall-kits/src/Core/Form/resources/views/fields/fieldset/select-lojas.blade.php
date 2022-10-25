<fieldset wire:ignore x-data="{}" style="font-size: 10px !important; " >
    <select x-init="new TomSelect($el);" multiple wire:model{{ $field->wire_model }}="{{ $field->key }}"
        {!! $field->merge(['class' => $field->class, 'id' => $field->name]) !!} style="">
        <option value="">{{ __('Selecione') }}</option>
        @if ($field->options)
            @foreach ($field->options as $key => $value)
                <option value="{{ $value['id'] }}">{{ $value['codigo'] }} - {{ $value['nome'] }}</option>
            @endforeach
        @endif
    </select>
    <x-input-help :message="$field->help" :link="$field->link" />
    <x-input-error :for="$field->key" />
</fieldset>
<style>
    .ts-wrapper{
        padding: 0 !important;
    }
    .ts-control .item{
        font-size: 9px;
        padding: 0;
        line-height: 11px;

    }

    .has-items .ts-control > input {
       margin: 0px 2px 0 0px  !important;
        border: 1px solid #2f64e5 !important;
        border-radius: 3px;
    }
</style>
