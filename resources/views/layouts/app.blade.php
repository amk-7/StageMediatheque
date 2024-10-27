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
    @yield("styles")
</head>

<body class="bg-white">
    <div class="h-screen" x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
        <!-- nav bar -->
        @include('layouts.navigation')
        <div class="flex antialiased text-gray-900">
            <!-- Loading screen -->
            <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-yellow-800">
                Chargement.....
            </div>
            <!-- Sidebar -->
            <div class="flex flex-shrink-0 h-full transition-all fixed mt-16" id="dashbord" style="z-index: 1000">
                @if(Auth::user())
                    @include('layouts.side_bar')
                @endif
            </div>
            @php
                $classe = "";
                if (Auth::user()){
                    $classe = $classe."flex items-center justify-center flex-1 px-0 py-8 mt-16";
                } else {
                    $classe = "flex flex-col items-center justify-center w-full mt-32";
                }
            @endphp
            <main id="main" class="{{ $classe ?? '' }}">
                @yield('content')
            </main>
        </div>
        @if(request()->routeIs('welcome') )
            @include('layouts.footer')
        @endif
        <div x-show="isSettingsPanelOpen" class="fixed inset-0 bg-black bg-opacity-50" @click="isSettingsPanelOpen = false" aria-hidden="true"></div>
    </div>
    </div>
    
    <script src="/assets/sweetalert2.all.min.js"></script>
    <script>
        function AlertSwalInfo(title, message, icon){
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
                confirmButtonColor: "#16A34A",
                confirmButtonText: "OK",
            });
        }

        function AlertSwal(title, message, icon, form_tag){
            event.preventDefault();
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: "#16A34A",
                cancelButtonColor: "#DC2626",
                confirmButtonText: "Oui",
                cancelButtonText: "Annuler",
            }).then((result) => {
                if (result.isConfirmed && form_tag != "") {
                    $(`#${form_tag}`).submit();
                }
            });
        }
    </script>
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
        };
        // console.log(Swal);
    </script>
    <script src="/assets/jquery.min.js"></script>
    <script src="/assets/select2.min.js"></script>
    <script src="/assets/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
    @yield("js")
    @yield("js_again")
</body>

</html>