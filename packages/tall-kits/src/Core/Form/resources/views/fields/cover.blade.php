{{--/**--}}
{{-- * Created by Claudio Campos.--}}
{{-- * User: callcocam@gmail.com, contato@sigasmart.com.br--}}
{{-- * https://www.sigasmart.com.br--}}
{{-- */--}}
    @if(isset($form_data[$field->name]) && $form_data[$field->name] && is_object($form_data[$field->name]))
        @livewire('form-cover', [
        'cover'=>$form_data[$field->name],
        'name'=>$field->name,
        ])
    @else
        <div class="d-flex flex-column justify-content-center">
            <div class="w-100">
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($form_data[$field->name]) }}"
                    style="width: 100%; max-width: 100%;">
            </div>
        </div>
        <div class="input-group mb-3">
            <x-label class="input-group-text" for="{{ $field->name }}">
                <i class="bi bi-upload"></i>
            </x-label>
            <input wire:model="{{ $field->key }}" {!! $field->merge(['class'=>$field->class, 'id' => $field->name]) !!}>
        </div>
        <x-input-help :message="$field->help"/>
        <x-input-error :for="$field->key"/>
    @endif

