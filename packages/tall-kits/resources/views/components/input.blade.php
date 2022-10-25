@props(['field'])
<input {{ $attributes->merge($field->attributes()) }} />