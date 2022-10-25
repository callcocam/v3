@props(['field'])
<input {{ $attributes->merge($field->attributes()) }}  x-mask:dynamic="$money($input, ',')"/>