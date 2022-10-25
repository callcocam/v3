@if($field->options)
    <ul class="list-unstyled mb-0">
        @foreach($field->options as $key => $value)
            <li class="d-inline-block me-2 mb-1">
                <div class="form-check">
                    <div class="custom-control custom-checkbox">
                        <input  wire:model{{ $field->wire_model }}="{{ $field->key }}.{{$key}}" {!! $field->merge(['class'=>"form-check-input form-check-primary"]) !!}
                               name="{{$key}}" id="{{$key}}">
                        <label class="form-check-label"
                               for="{{$key}}">{{ $value }}</label>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif






