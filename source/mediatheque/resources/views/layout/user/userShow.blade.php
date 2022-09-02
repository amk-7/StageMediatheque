@extends('layout.base')

@section('content')

<form method="GET" action="{{route($action, $model)}}">
    {{--dd($utilisateur->adresse)--}}
@csrf
<fieldset>
    <legend>{{$title}}</legend>
    <label>Identifiant de l'utilisateur : {{$utilisateur->id_utilisateur}}</label></br>
    <label>Photo_profil : {{$utilisateur->photo_profil}}</label></br>
    <label>Nom : {{$utilisateur->nom}}</label></br>
    <label>Prenom : {{$utilisateur->prenom}}</label></br>
    <label>Nom d'utilisateur : {{$utilisateur->nom_utilisateur}}</label></br>
    <label>Email : {{$utilisateur->email}}</label></br>
    <label>Mot de passe : {{$utilisateur->password}}</label></br>
    <label>Contact : {{$utilisateur->contact}}</label></br>
    <label>Ville : {{$utilisateur->adresse["ville"]}}</label></br>
    <label>Quartier : {{$utilisateur->adresse["quartier"]}}</label></br>
    <label>Sexe : {{$utilisateur->sexe}}</label></br>

    @yield('abonne')
    @yield('personnel')

</fieldset>
</form>
<button type="Submit">Retour</button>
<button type="Submit">Suivant</button>

@endsection