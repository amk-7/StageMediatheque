<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield("livewire_styles_content")
    @yield("styles")

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100">
<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
    <!-- nav bar -->
    @include('layouts.navigation')
    <div class="flex h-screen antialiased text-gray-900 dark:bg-dark dark:text-light">
        <!-- Loading screen -->
        <div
            x-ref="loading"
            class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-yellow-800"
        >
            Chargement.....
        </div>
        <!-- Sidebar -->
            <div class="flex hidden flex-shrink-0 h-full transition-all fixed mt-16" id="dashbord" hidden>
                @if(Auth::user())
                    @include('side_bar.side_bar')
                @endif
            </div>
            <main class="flex items-center justify-center flex-1 px-4 py-8 mt-16 ml-16">
                <!-- Content -->
                @yield('content')
            </main>
    </div>

    <!-- Panels -->

    <!-- Settings Panel -->
    <!-- Backdrop -->
    <div
        x-show="isSettingsPanelOpen"
        class="fixed inset-0 bg-black bg-opacity-50"
        @click="isSettingsPanelOpen = false"
        aria-hidden="true"
    ></div>
    <!-- Panel -->
    <section
        x-transition:enter="transform transition-transform duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition-transform duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        x-show="isSettingsPanelOpen"
        class="fixed inset-y-0 right-0 w-64 bg-white border-l border-indigo-100 rounded-l-3xl"
    >
        <div class="px-4 py-8">
            <h2 class="text-lg font-semibold">Settings</h2>
        </div>
    </section>
</div>
</div>

<script async>
    const setup = () => {
        return {
            isSidebarOpen: false,
            currentSidebarTab: null,
            isSettingsPanelOpen: false,
            isSubHeaderOpen: false,
            watchScreen() {
                if (window.innerWidth <= 1024) {
                    this.isSidebarOpen = false
                }
            },
        }
    }
</script>

@yield("livewire_scripts_content")
@yield("js")

</body>
</html>
