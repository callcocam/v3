<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    @isset($head)
        {{ $head }}
    @endisset
    <!-- Styles -->
    @livewireStyles
</head>

<body x-data x-bind="$store.global.documentBody"
    class="@isset($isSidebarOpen) {{ $isSidebarOpen === 'true' ? 'is-sidebar-open' : '' }} @endisset @isset($isHeaderBlur) {{ $isHeaderBlur === 'true' ? 'is-header-blur' : '' }} @endisset @isset($hasMinSidebar) {{ $hasMinSidebar === 'true' ? 'has-min-sidebar' : '' }} @endisset">
    <x-tall-app-preloader></x-tall-app-preloader>
    <!-- Page Wrapper -->
    <div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak>
        <!-- Sidebar -->
        <div class="sidebar print:hidden">
            <!-- Main Sidebar -->
            @livewire('tall::includes.partials.sidebar.main-component')

            <!-- Sidebar Panel -->
            @livewire('tall::includes.partials.sidebar.panel-component')
            {{-- <x-app-partials.sidebar-panel></x-app-partials.sidebar-panel> --}}
        </div>
        
        <!-- App Header -->
        @livewire('tall::includes.partials.header-component')
        {{-- <x-app-partials.header></x-app-partials.header> --}}
        
        <!-- Mobile Searchbar -->
        @livewire('tall::includes.partials.mobile.searchbar-component')
        {{-- <x-app-partials.mobile-searchbar></x-app-partials.mobile-searchbar> --}}
        
        <!-- Right Sidebar -->
        @livewire('tall::includes.partials.sidebar.right-component')
        {{-- <x-app-partials.right-sidebar></x-app-partials.right-sidebar> --}}

        {{ $slot }}

    </div>
    <!--
  This is a place for Alpine.js Teleport feature
  @see https://alpinejs.dev/directives/teleport
-->
    <div id="x-teleport-target"></div>

    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>

    @isset($script)
        {{ $script }}
    @endisset
    <x-tall-notifications></x-tall-notifications>
    @livewireScripts
</body>

</html>
