@extends('layout.template.base')
@section('content')
    <div class="flex flex-col">
        <div class="p-12 flex flex-col items-center mr-16" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 20px; background-color: white">
            <div name="logo">
                <a href="{{ route('listeLivresNumerique') }}" class="flex">
                    <img src="{{ asset('storage/images/logo.png') }}" class="block h-10 w-auto fill-current text-gray-600">
                    <img src="{{ asset('storage/images/logo2.png') }}" class="block h-10 w-auto fill-current text-gray-600">
                </a>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                             type="password"
                             name="password"
                             required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot password') }}
                        </a>
                    @endif

                    <button class="ml-3 button button_primary">
                        {{ __('Log In') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
