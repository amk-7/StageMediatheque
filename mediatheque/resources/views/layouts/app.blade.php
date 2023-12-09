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
    <link rel="stylesheet" href="/assets/select2.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
</head>
<body class="bg-gray-100">
<div class="h-screen" x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
    <!-- nav bar -->
    @include('layouts.navigation')
    <div class="flex antialiased text-gray-900">
        <!-- Loading screen -->
        <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-yellow-800">
            Chargement.....
        </div>
        <!-- Sidebar -->
        {{-- @php
            $welcome
        @endphp --}}
        <div class="flex flex-shrink-0 h-full transition-all fixed mt-16" id="dashbord" style="z-index: 1000">
            @if(Auth::user() && ! request()->routeIs('welcome') )
                @include('layouts.side_bar')
            @endif
        </div>
        @php
            $classe = "";
            if (Auth::user()){
                $classe = $classe."flex items-center justify-center flex-1 px-4 py-8 mt-16";
            } else {
                $classe = "flex flex-col items-center justify-center w-full mt-32";
            }
        @endphp
        <main style="" id="main" class="{{ $classe ?? "" }}">
            @yield('slider')
            <!-- Content -->
            @yield('content')
        </main>
    </div>
    @if(request()->routeIs('welcome') )
        @include('layouts.footer')
    @endif
    <div
        x-show="isSettingsPanelOpen"
        class="fixed inset-0 bg-black bg-opacity-50"
        @click="isSettingsPanelOpen = false"
        aria-hidden="true"
    ></div>
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
<script src="/assets/jquery.min.js"></script>
<script src="/assets/select2.min.js"></script>
@yield("js")
</body>
</html>
