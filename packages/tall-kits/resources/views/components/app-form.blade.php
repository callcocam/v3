@props(['attr'])
<form wire:submit.prevent='saveAndStay' class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            {{ __('Dashboard') }}
        </h2>
        <div class="hidden h-full py-1 sm:flex">
            <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
        </div>
        <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
            <li class="flex items-center space-x-2">
                <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                    href="{{ data_get($attr, 'route') }}"> {{ data_get($attr, 'title') }}</a>
                <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewbox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </li>
            <li> {{ data_get($attr, 'description') }}</li>
        </ul>
    </div>

    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        @isset($left)
            <div class="col-span-12 lg:col-span-4">
                <div class="card p-4 sm:p-5">
                    {{ $left }}
                </div>
            </div>
        @endisset
        <div class="col-span-12 {{ isset($left) || isset($right) ? 'lg:col-span-8':'' }}">
            <div class="card">
                <div
                    class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        {{ __('Setting') }} - {{ data_get($attr, 'description') }}
                    </h2>
                    <div class="flex justify-center space-x-2">
                        @if ($condition = data_get($attr, 'route'))
                            <a href="{{ $condition }}"
                                class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                {{ __('Cancel') }}
                            </a>
                        @endif
                        <button
                            class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            {{ __('Save & Update') }}
                        </button>
                    </div>
                </div>
                <div class="p-4 sm:p-5">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                        {{ $slot }}
                    </div>
                    @isset($actions)
                        <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                        <div>
                            {{ $actions }}
                        </div>
                    @endisset
                </div>
            </div>
        </div>
        @isset($right)
            <div class="col-span-12 lg:col-span-4">
                <div class="card p-4 sm:p-5 flex flex-col gap-y-4">
                    {{ $right }}
                </div>
            </div>
        @endisset
    </div>
</form>
