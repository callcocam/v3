@props(['title', 'tab'])
<div x-show="activeSettingsTab === '{{ $tab }}'" x-transition:enter="transition-all duration-500 easy-in-out"
    x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
    class="is-scrollbar-hidden overflow-y-auto overscroll-contain pt-1">
    @isset($action)
        {{ $action }}
    @endisset
    <div class="mt-3 px-3">
        <h2 class="text-xs+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
            {{ $title }}
        </h2>
        {{ $slot }}
    </div>
    <div class="h-18"></div>
</div>
