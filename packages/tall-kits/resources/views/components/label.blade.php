@props(['field'])
<div class="{{ sprintf('col-span-%s', $field->span) }}">
    <label class="block">
        <span>{{ $field->label }} </span>
        <span class="relative mt-1.5 flex flex-col">
            {{ $slot }}
            @if ($icon = $field->icon)
                <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <i class="{{ $icon }}"></i>
                </span>
            @endif
        </span>
    </label>
</div>
