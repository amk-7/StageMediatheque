<nav x-data="{ open: false }" class="bg-white w-full border-b border-gray-100 fixed" style="z-index: 999">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <img src="{{ asset('storage/images/logo.png') }}" class="block h-10 w-auto fill-current text-gray-600">
                    </a>
                    <a href="/">
                        <img src="{{ asset('storage/images/logo2.png') }}" class="block h-10 w-auto fill-current text-gray-600">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('listeLivresNumerique')" :active="request()->routeIs('listeLivresNumerique')">
                        {{ __('Livres pdf') }}
                    </x-nav-link>
                    <x-nav-link :href="route('listeLivresPapier')" :active="request()->routeIs('listeLivresPapier')">
                        {{ __('Livres papier') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden space-x-6 sm:flex sm:items-center sm:ml-6">
                @if(Auth::guest())
                    <div class="flex space-x-1">
                        <button class="button button_show">
                            <a href="/register">{{ __("Register") }}</a>
                        </button>
                        <button class="button button_primary">
                            <a href="/login">{{ __("Log In") }}</a>
                        </button>
                    </div>
                @endif
                @if(Auth::user())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div class="rounded-full mr-3" style="width: 50px; height: 50px; background: #00ff00">
                                    <img class="rounded-full" style="width: 100%; height: 100%; padding: 3px" src="{{ asset("storage/images/image_utilisateur")."/".Auth::user()->photo_profil }}">
                                </div>
                                <div>{{ Auth::user()->nom }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @if(Auth::guest())
            <div class="pt-2 pb-3 space-y-1">
                <!--button class="button button_show">
                    <a href="/register">{ { __("Register") }}</a>
                </button>
                <button class="button button_primary">
                    <a href="/login">{ { __("") }}</a>
                </button-->
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Log In') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('listeLivresNumerique')" :active="request()->routeIs('listeLivresNumerique')">
                    {{ __('Livres pdf') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('listeLivresPapier')" :active="request()->routeIs('listeLivresPapier')">
                    {{ __('Livres papier') }}
                </x-responsive-nav-link>
            </div>
        @endif
        <!-- Responsive Settings Options -->
        @if(Auth::user())
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->nom }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <x-responsive-nav-link :href="route('listeLivresNumerique')" :active="request()->routeIs('listeLivresNumerique')">
                    {{ __('Livres pdf') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('listeLivresPapier')" :active="request()->routeIs('listeLivresPapier')">
                    {{ __('Livres papier') }}
                </x-responsive-nav-link>
                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endif
    </div>
</nav>

