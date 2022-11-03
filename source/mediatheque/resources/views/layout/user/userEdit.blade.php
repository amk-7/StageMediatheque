@extends('layout.template.base')

@section('content')

<form method="POST" action="{{route($action, $model)}}" enctype="multipart/form-data" class="bg-white p-12 m-auto">
<h1 class="label_title text-center pb-12">{{$title}}</h1>
<fieldset>
    {{csrf_field()}}
    {{ method_field('PUT') }}

    <div class="flex flex-row space-x-3 justify-center items-center">
        <div class="w-2/6" >
            <label class="label" for="nom">Nom</label>
            <input type="text" name="nom" value="{{$utilisateur->nom}}" class="input" >
        </div>

        <div class="w-2/6">
            <label class="label" for="prenom">Prenom</label>
            <input type="text" name="prenom" value="{{$utilisateur->prenom}}" class="input">
        </div>

        <div class="w-2/6">
            <label class="label" for="nom_utilisateur">Nom d'utilisateur</label>
            <input type="text" name="nom_utilisateur" value="{{$utilisateur->nom_utilisateur}}" class="input">
        </div>
    </div>

    <div class="flex flex-row space-x-3">
        <div class="flex flex-col w-1/3 mt-6 mr-3">
            <div>
                <label class="label" for="photo_profil">Photo de profil : </label>
            </div>
            <div class="border border-gray-200 text-center">
                <img src="{{asset('storage/images/image_utilisateur').'/'.$model->utilisateur->photo_profil}}" width="200" height="200" size>
            </div>
            <div class="flex flex-col-reverse p-2">
                <input type="file" name="photo_profil" value="{{$utilisateur->photo_profil}}">
            </div>

        </div>
        <div class="flex flex-col w-2/3 mt-6">
            <div>
                <label class="label" for="email">Email</label>
                <input type="text" name="email" value="{{$utilisateur->email}}" class="input">
            </div>

            <div>
                <label class="label" for="contact">Contact</label>
                <input type="tel" name="contact" value="{{$utilisateur->contact}}" class="input">
            </div>
        </div>
    </div>

    <div>
        <label class="label" for="adresss">Adresss</label>
        <div class="flex flex-row space-x-2 justify-center items-center">
            <div class="w-2/6">
                <label class="label" for="ville">Ville</label>
                <input type="text" name="ville" value="{{$utilisateur->adresse['ville']}}" class="input">
            </div>

            <div class="w-2/6">
                <label class="label" for="quartier">Quartier</label>
                <input type="text" name="quartier" value="{{$utilisateur->adresse['quartier']}}" class="input">
            </div>

            <div class="w-2/6">
                <label class="label" for="numero_maison">Numero de maison</label>
                <input type="text" name="numero_maison" value="{{$utilisateur->adresse['numero_maison']}}" class="input">
            </div>
        </div>
    </div>

    <div class="flex flex-col">
            <label class="label" for="sexe">Sexe : </label>
            <div class="flex flex-row space-x-8 text-center">
                <div class="label">
                    <input type="radio" name="sexe" value="Masculin" {{ $utilisateur->sexe == "Masculin" ? "checked" : "" }}/>
                    <label>Masculin</label>
                </div>
                <div class="label">
                    <input type="radio" name="sexe" value="Feminin" {{ $utilisateur->sexe == "Feminin" ? "checked" : "" }}/>
                    <label>Feminin</label>
                </div>
            </div>
    </div>

    @yield('abonne')
    @yield('personnel')

    <button class="button button_primary w-full mt-12" type="Submit">Modifier</button>
</fieldset>
</form>
@include("layout.ouvrageZJS.ouvrageLoadFile")
@stop
