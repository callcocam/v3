@props(['tab'=>'tabColumns'])
<div x-show="showSettings"
    @keydown.window.escape="$wire.showSetting(false)">
    <div class="fixed inset-0 z-[150] bg-slate-900/60 transition-opacity duration-200"
        wire:click="showSetting(false)"
        x-show="showSettings" x-transition:enter="ease-out"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
    <div class="fixed right-0 top-0 z-[151] h-full w-full sm:w-80">
        <div x-data="{ activeSettingsTab: @entangle('activeSettingsTab').defer}"
            class="relative flex h-full w-full transform-gpu flex-col bg-white transition-transform duration-200 dark:bg-navy-750"
            x-show="showSettings" x-transition:enter="ease-out"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="ease-in" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full">
            {{ $slot }}
        </div>
    </div>
</div>
