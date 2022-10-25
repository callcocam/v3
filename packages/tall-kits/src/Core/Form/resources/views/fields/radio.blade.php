@if($field->options)
    <x-label fo="{{ $field->name }}">{{ __($field->label) }}:
        @if($field->rules)
            <span class="text-danger">*</span>
        @endif
    </x-label>
    <div class="form-group">
    <ul class="list-unstyled mb-0">
        @foreach($field->options as $key => $value)
            <li class="d-inline-block me-2 mb-1">
                <div class="form-check">
                    <div class="custom-control custom-checkbox">
                        <input  wire:model{{ $field->wire_model }}="{{ $field->key }}" {!! $field->merge(['class'=>"form-check-input form-check-primary"]) !!}
                               name="{{$field->name  }}" id="{{$key}}" value="{{$key}}">
                        <label class="form-check-label"
                               for="{{$key}}">{{ $value }}</label>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    </div>
@endif






