@extends('layout.base')

@section('content')

<form method="POST" action="{{route($action)}}">
@csrf
<fieldset>
    <legend>{{$title}}</legend>
    <div>
        <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="@error('nom') is-invalid @enderror">
            @error('nom')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="prenom">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" class="@error('prenom') is-invalid @enderror">
            @error('prenom')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="nom_utilisateur">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur" class="@error('nom_utilisateur') is-invalid @enderror">
            @error('nom_utilisateur')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" class="@error('email') is-invalid @enderror">
            @error('email')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" class="@error('password') is-invalid @enderror">
            @error('password')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="contact">Contact</label>
            <input type="tel" class="form-control" id="contact" name="contact" class="@error('contact') is-invalid @enderror">
            @error('contact')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="profil">Photo de profil</label>
            <input type="text" class="form-control" id="photo_profil" name="photo_profil" class="@error('ville') is-invalid @enderror">
            @error('photo_profil')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="adresse">Adresse</label>
            <div>
                <label for="ville">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" class="@error('ville') is-invalid @enderror">
                @error('ville')
                    <div class="alert">{{ $message }}</div>
                @enderror
                
                <label for="quartier">Quartier</label>
                <input type="text" class="form-control" id="quartier" name="quartier" class="@error('quartier') is-invalid @enderror">
                @error('quartier')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
    </div>

    <div>
        <label for="sexe">Sexe</label>
            <div>
                <input type="radio" name="sexe" value="Masculin">Masculin
                <input type="radio" name="sexe" value="Feminin">Feminin
            </div>
    </div>

    @yield('abonne')
    @yield('personnel')
    <button type="Submit">Ajouter le personnel</button>
</fieldset>
</form>
@endsection