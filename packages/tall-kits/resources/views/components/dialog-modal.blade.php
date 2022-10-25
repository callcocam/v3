@props(['id' => null, 'maxWidth' => null])

<x-tall-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-slate-50 dark:bg-navy-400 text-right">
        {{ $footer }}
    </div>
</x-tall-modal>
