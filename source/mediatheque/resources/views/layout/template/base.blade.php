<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Icon -->
    <link rel="icon" type="image/png" sizes="50x50" href="{{ asset('storage/images/logo2.png') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield("livewire_styles_content")
    <style>
        @media only screen and (min-width: 768px) {
            /* For desktop: */
            .col-1 {width: 8.33%;}
            .col-2 {width: 16.66%;}
            .col-3 {width: 25%;}
            .col-4 {width: 33.33%;}
            .col-5 {width: 41.66%;}
            .col-6 {width: 50%;}
            .col-7 {width: 58.33%;}
            .col-8 {width: 66.66%;}
            .col-9 {width: 75%;}
            .col-10 {width: 83.33%;}
            .col-11 {width: 91.66%;}
            .col-12 {width: 100%;}
        }

        @media (max-width: 400px) {
            .my_content {
                width: 380px;
                margin-bottom: 100px;
            }

            .my_content2 {
                width: 342px;
                height: 550px;
            }
        }
    </style>
    @yield("styles")

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100">
<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
    <!-- nav bar -->
    @include('layout.template.navigation')
    <div class="flex h-screen antialiased text-gray-900 dark:bg-dark dark:text-light">
        <!-- Loading screen -->
        <div
            x-ref="loading"
            class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-yellow-800"
        >
            Chargement.....
        </div>
        <!-- Sidebar -->
            <div class="flex flex-shrink-0 h-full transition-all fixed mt-16" id="dashbord" style="z-index: 1000">
                @if(Auth::user())
                    @include('side_bar.side_bar')
                @endif
            </div>
            {{--
            class=@if(Auth::user())"flex items-center justify-center flex-1 px-4 py-8 mt-16"@else"my_content flex items-center justify-center flex-1 px-4 py-8"@endif
            --}}
            @php
                $classe = "my_content ";
                if (Auth::user()){
                    $classe = $classe."flex items-center justify-center flex-1 px-4 py-8 mt-16";
                } else {
                    $classe = $classe."flex items-center justify-center flex-1 px-4 py-8";
                }
            @endphp
            <main style="" id="main" class="{{ $classe }}">
                @yield('slider')
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
<div id="main" style="width: 100%" class=@if(Auth::user())"ml-16"@else "" @endif>
    @yield("footer")
</div>
</body>
</html>
