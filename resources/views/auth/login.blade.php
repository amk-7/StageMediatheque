@extends('layouts.app')
@section('content')
    <div class="flex flex-col">
        <div class="p-12 flex flex-col items-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 20px; background-color: white">
            <div name="logo">
                <a href="{{ route('welcome') }}" class="flex">
                    <img src="{{ asset('storage/images/logo.png') }}" class="block h-10 w-auto fill-current text-gray-600">
                    <img src="{{ asset('storage/images/logo2.png') }}" class="block h-10 w-auto fill-current text-gray-600">
                </a>
            </div>

            @if ($errors->all())
                <li class="error">Itentifiants invalide</li>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label for="nom_utilisateur">Nom utilisateur</label>
                        <input type="text" name="nom_utilisateur" class="input" required>
                    </div>
                    <div>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="input" required>
                    </div>
                </div>
                <button class="button button_primary w-full mt-8">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
@stop
