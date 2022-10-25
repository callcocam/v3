<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
                <div class="grid grid-cols-12">
                    <div class="col-span-1"></div>
                    <div class="col-span-2"></div>
                    <div class="col-span-3"></div>
                    <div class="col-span-4"></div>
                    <div class="col-span-5"></div>
                    <div class="col-span-6"></div>
                    <div class="col-span-7"></div>
                    <div class="col-span-8"></div>
                    <div class="col-span-9"></div>
                    <div class="col-span-10"></div>
                    <div class="col-span-11"></div>
                    <div class="col-span-12"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
