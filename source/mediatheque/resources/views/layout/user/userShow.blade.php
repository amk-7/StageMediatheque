@extends('layout.template.base')

@section('content')

<form method="GET" action="{{route($action, $model)}}">
    {{--dd($utilisateur->adresse)--}}
@csrf
<h1 class="label_title text-center pb-12">{{$title}}</h1>

<fieldset>
<div class="flex flex-row space-x-3 justify-center items-center">
    <div class="flex flex-row space-x-3">
        <label>Photo de profil : </label></br>
        <img src="{{asset('storage/images/image_utilisateur').'/'.$model->utilisateur->photo_profil}}" width="350" height="300"></br>
        
        <div class="flex flex-col w-2/3 mt-6">
            <div class="label">
                <label>Identifiant de l'utilisateur : </label>
                <label>{{$utilisateur->id_utilisateur}}</label>
            </div>
            <div class="label">
                <label>Nom : </label>
                <label>{{$utilisateur->nom}}</label>
            </div>
        
            <div class="label">
                <label>Prenom : </label>
                <label>{{$utilisateur->prenom}}</label>
            </div>
        
        <div class="label">
            <label>Nom d'utilisateur : </label>
            <label>{{$utilisateur->nom_utilisateur}}</label>
        </div>

        <div class="label">
            <label>Email : </label>
            <label>{{$utilisateur->email}}</label>
        </div>

        <div class="label">
            <label>Contact : </label>
            <label>{{$utilisateur->contact}}</label>
        </div>

        <div class="label">
            <label>Ville : </label>
            <label>{{$utilisateur->adresse["ville"]}}</label>
        </div>

        <div class="label">
            <label>Quartier : </label>
            <label>{{$utilisateur->adresse["quartier"]}}</label>
        </div>

        <div class="label">
            <label>Numero de maison : </label>
            <label>{{$utilisateur->adresse["numero_maison"]}}</label>
        </div>

        <div class="label">
            <label>Sexe : </label>
            <label>{{$utilisateur->sexe}}</label>
        </div>
    

    @yield('abonne')
    @yield('personnel')
    </div>
</div>
</fieldset>
<div class="flex flex-row space-x-3 justify-center items-center">
    <div>
        <button class="button button_primary w-full mt-12" type="Submit">Retour</button>
    </div>
    <div>
        <button class="button button_primary w-full mt-12" type="Submit">Suivant</button>
    </div>
</div>
</form>


@stop