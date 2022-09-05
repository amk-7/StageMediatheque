@extends('layout.base')

@section('content')

<form method="POST" action="{{route($action)}}" enctype="multipart/form-data" class="bg-white p-12 m-auto">
@csrf
<fieldset>
    <legend>{{$title}}</legend>

    <div>
        <label>Photo de profil</label>
    </div>

    <div class="flex flex-row m-3">
        <div class="border border-gray-200 text-center">
            <img src="" alt="photo_profil" id="profil_object" size>
        </div>
        <div class="flex flex-col-reverse p-2">
            <input type="file" onchange="previewPicture(this)" name="photo_profil" id="" value=""
                accept="image/jpg, image/jpeg, image/png, image/jpeg"><br>
        </div>
    </div>
    
    <div>
        <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom"  value="{{old('nom')}}" class="@error('nom') is-invalid @enderror">
            @error('nom')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="prenom">Prenom</label>
            <input type="text" class="form-control" id="prenom" value="{{old('prenom')}}" name="prenom" class="@error('prenom') is-invalid @enderror">
            @error('prenom')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="nom_utilisateur">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="nom_utilisateur" value="{{old('nom_utilisateur')}}" name="nom_utilisateur" class="@error('nom_utilisateur') is-invalid @enderror">
            @error('nom_utilisateur')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="email">Email</label>
            <input type="text" class="form-control" id="email" value="{{old('email')}}" name="email" class="@error('email') is-invalid @enderror">
            @error('email')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" value="{{old('password')}}" name="password" class="@error('password') is-invalid @enderror">
            @error('password')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="contact">Contact</label>
            <input type="tel" class="form-control" id="contact" value="{{old('contact')}}" name="contact" class="@error('contact') is-invalid @enderror">
            @error('contact')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="adresse">Adresse : </label>
            <div>
                <label for="ville">Ville</label>
                <input type="text" class="form-control" id="ville" value="{{old('ville')}}" name="ville" class="@error('ville') is-invalid @enderror">
                @error('ville')
                    <div class="alert">{{ $message }}</div>
                @enderror
                
                <label for="quartier">Quartier</label>
                <input type="text" class="form-control" id="quartier" value="{{old('quartier')}}" name="quartier" class="@error('quartier') is-invalid @enderror">
                @error('quartier')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
    </div>

    <div>
        <label for="sexe">Sexe : </label>
            <div>
                <input type="radio" name="sexe" value="Masculin">Masculin</br>
                <input type="radio" name="sexe" value="Feminin">Feminin</br>
            </div>
    </div>

    @yield('abonne')
    @yield('personnel')
    <button type="Submit">Ajouter le personnel</button>
</fieldset>
</form>
@include("layout.ouvrageZJS.ouvrageLoadFile")

@endsection