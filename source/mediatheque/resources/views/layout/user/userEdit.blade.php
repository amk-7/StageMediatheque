@extends('layout.base')

@section('content')

<form method="POST" action="{{route($action, $model)}}" enctype="multipart/form-data" class="bg-white p-12 m-auto">
<fieldset>
    {{csrf_field()}}
    {{ method_field('PUT') }}
    <div>
        <label for="photo_profil">Photo de profil : </label></br>
        <input type="file" name="photo_profil" value="{{$utilisateur->photo_profil}}">
        <img src="{{asset('storage/images/image_utilisateur').'/'.$model->utilisateur->photo_profil}}" width="350" height="300">
    </div>
    
    <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" value="{{$utilisateur->nom}}">
    </div>

    <div>
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" value="{{$utilisateur->prenom}}">
    </div>

    <div>
        <label for="nom_utilisateur">Nom d'utilisateur</label>
        <input type="text" name="nom_utilisateur" value="{{$utilisateur->nom_utilisateur}}">
    </div>
    
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" value="{{$utilisateur->email}}">
    </div>

    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" value="{{$utilisateur->password}}">
    </div>

    <div>
        <label for="contact">Contact</label>
        <input type="tel" name="contact" value="{{$utilisateur->contact}}">
    </div>

    <div>
        <label for="adresss">Adresss</label>
        <div>
            <label for="ville">Ville</label>
            <input type="text" name="ville" value="{{$utilisateur->adresse['ville']}}">
        
            <label for="quartier">Quartier</label>
            <input type="text" name="quartier" value="{{$utilisateur->adresse['quartier']}}">

            <label for="numero_maison">Numero de maison</label>
            <input type="text" name="numero_maison" value="{{$utilisateur->adresse['numero_maison']}}">
        </div>
    </div>

    <div>
        <label for="sexe">Sexe</label>
        <input
            type="radio"
            name="sexe" value="{{$utilisateur->sexe}}" 
            @if($utilisateur->sexe == 'Homme')
                checked
            @endif
        >Homme
        <input
            type="radio"
            name="sexe" value="{{$utilisateur->sexe}}" 
            @if($utilisateur->sexe == 'Femme')
                checked
            @endif
        >Femme
    </div>

    @yield('abonne')
    @yield('personnel')

    <button type="Submit">Modifier</button>
</fieldset>
</form>
@include("layout.ouvrageZJS.ouvrageLoadFile")
@stop
