@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-12 md:gap-6']) }}>
    @isset($title)
        <x-tall-section-title class="col-span-12">
            <x-slot name="title">{{ $title }}</x-slot>
            @isset($description)
                <x-slot name="description">{{ $description }}</x-slot>
            @endisset
        </x-tall-section-title>
    @endisset

    <div class="mt-5 md:mt-0 md:col-span-12">
        <form wire:submit.prevent="{{ $submit }}">
            <div
                class="px-4 py-5 grid grid-cols-12 gap-6 bg-slate-50 dark:bg-navy-500 sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                {{ $slot }}
            </div>

            @if (isset($actions))
                <div
                    class="flex items-center justify-end px-4 py-3  bg-slate-100 dark:bg-navy-400 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
