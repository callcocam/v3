@props(['attr', 'filters', 'models', 'tableConfig' => null])
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center justify-between py-5 lg:py-6">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                {{ __('Dashboard') }}
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="text-lg"> {{ data_get($attr, 'title') }}</li>
            </ul>
        </div>

        <div class="flex items-center space-x-2">
            @isset($search)
                {{ $search }}
            @endisset
            <div class="flex">
                @isset($actions)
                    {{ $actions }}
                @endisset

                @if ($tableConfig)
                    @livewire('tall::admin.operacional.cms.table.settings-component', ['tableConfig' => $tableConfig], key('table'))
                @endif
            </div>
        </div>
    </div>
    {{ $slot }}
</main>
