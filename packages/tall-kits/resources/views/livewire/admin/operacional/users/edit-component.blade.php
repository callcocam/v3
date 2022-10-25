<x-tall-app-form :attr="$formAttr">
    @if ($fields)
        <x-slot name="right">
            @if ($field = form('profile_photo_path', $fields))
                <x-dynamic-component component="{{ $field->component }}" :field="$field" />
            @endif
            @if ($field = form('created_at', $fields))
                <x-tall-label :for="$field->name" :field="$field">
                    <x-dynamic-component component="{{ $field->component }}" :field="$field" />
                    <x-tall-input-error :for="$field->name" class="mt-2" />
                </x-tall-label>
            @endif
            @if ($field = form('updated_at', $fields))
                <x-tall-label :for="$field->name" :field="$field">
                    <x-dynamic-component component="{{ $field->component }}" :field="$field" />
                    <x-tall-input-error :for="$field->name" class="mt-2" />
                </x-tall-label>
            @endif
        </x-slot>
        @foreach ($fields as $field)
            @if ($field->condition)
                <x-tall-label :for="$field->name" :field="$field">
                    <x-dynamic-component component="{{ $field->component }}" :field="$field" />
                    <x-tall-input-error :for="$field->name" class="mt-2" />
                </x-tall-label>
            @endif
        @endforeach
    @endif
</x-tall-app-form>
