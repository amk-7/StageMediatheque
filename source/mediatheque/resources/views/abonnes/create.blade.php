@extends('layout.user.userCreate', ['action'=>"storeAbonne", 'title'=>"Ajouter un abonné"])

@section('abonne')
    <form method="POST" action="{{route('storeAbonne')}}">
        @csrf
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
        <label for="profil">Photo_profil</label>
            <input type="text" class="form-control" id="photo_profil" name="photo_profil">
        </div>
        <div>
        <label for="ville">Ville</label
            <input type="text" class="form-control" id="ville" name="ville" class="@error('ville') is-invalid @enderror">
            @error('ville')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div>
        <label for="quartier">Quartier</label>
            <input type="text" class="form-control" id="quartier" name="quartier" class="@error('quartier') is-invalid @enderror">
            @error('quartier')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div>
        <label for="sexe">Sexe<label>
            <select name="sexe" id="sexe">
                <option value="Masculin">Masculin</option>
                <option value="Feminin">Feminin</option>
            </select>
        </div>
        <div>
        <label for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance">
        </div>
        <div>
        <label for="niveau_etude">Niveau d'étude</label>
            <select name="niveau_etude" id="niveau_etude">
                <option value="1er dégré">1er dégré</option>
                <option value="2è dégré">2è dégré</option>
                <option value="3è dégré">3è dégré</option>
                <option value="Université">Université</option>
            </select>
        </div>

    <div>
        <label for="profession">Profession</label>
            <input type="text" name="profession" id="profession" class="@error('profession') is-invalid @enderror">
            @error('profession')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>
    
    <div>
        <label for="contact_a_prevenir">Contact à prévenir</label>
            <input type="text" name="contact_a_prevenir" id="contact_a_prevenir" class="@error('contact_a_prevenir') is-invalid @enderror">
            @error('contact_a_prevenir')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="numero_carte">Numéro de carte</label>
            <input type="text" name="numero_carte" id="numero_carte" class="@error('numero_carte') is-invalid @enderror">
            @error('numero_carte')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="type_de_carte">Type de carte</label>
            <input type="text" name="type_de_carte" id="type_de_carte" class="@error('type_de_carte') is-invalid @enderror">
            @error('type_de_carte')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

@endsection
