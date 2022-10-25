<fieldset>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">{{ __($field->label) }}
                @if(\Illuminate\Support\Str::contains($field->rules,"required"))
                    <span class="text-danger">*</span>
                @endif
            </span>
        </div>
        <select wire:model{{ $field->wire_model }}="{{ $field->key }}" {!! $field->merge(['class'=>$field->class, 'id'=>$field->name]) !!}>
            <option>=={{ __('Selecione') }}==</option>
            @if($field->options)
                @foreach($field->options as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <x-input-help :message="$field->help" :link="$field->link"/>
    <x-input-error :for="$field->key"/>
</fieldset>
@push('script')
    <script>
        $(document).ready(function () {
            $('#{{ $field->name }}').select2();
            $('#{{ $field->name }}').on('change', function (e) {
                let data = $('#{{ $field->name }}').select2("val");
            @this.set('{{ $field->key }}', data);
            });
        });
    </script>
@endpush
