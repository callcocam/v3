@props(['field'])
<div class="{{ sprintf('col-span-%s', $field->span) }}">
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            @if ($options = $field->options)
                @foreach ($options as $key => $value)
                    <label class="inline-flex items-center space-x-2">
                        <input value="{{$key}}" {{ $attributes->merge($field->attributes()) }} />
                        <p>{{ __($value) }}</p>
                    </label>
                @endforeach
            @endif
        </div>
    </div>
</div>
