<?php ?>
<h1>Création d'un nouvel personnel</h1>
<div>
    <form method="POST" action="{{route('storePersonnel')}}">
        @csrf
        <label for="nom">Nom
            <input type="text" name="nom" id="nom" class="@error('nom') is-invalid @enderror">
            @error('nom')
            <div class="alert">{{ $message }}</div>
            @enderror
        </label></br>
        <label for="prenom">Prenom
            <input type="text" class="form-control" id="prenom" name="prenom" class="@error('prenom') is-invalid @enderror">
            @error('prenom')
            <div class="alert">{{ $message }}</div>
            @enderror
        </label></br>
        <label for="nom_utilisateur">Nom d'utilisateur
            <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur" class="@error('nom_utilisateur') is-invalid @enderror">
            @error('nom_utilisateur')
            <div class="alert">{{ $message }}</div>
            @enderror
        </label></br>
        <label for="email">Email
            <input type="text" class="form-control" id="email" name="email" class="@error('email') is-invalid @enderror">
            @error('email')
            <div class="alert">{{ $message }}</div>
            @enderror
        </label></br>
        <label for="password">Mot de passe
            <input type="password" class="form-control" id="password" name="password" class="@error('password') is-invalid @enderror">
            @error('password')
            <div class="alert">{{ $message }}</div>
            @enderror
        </label></br>
        <label for="contact">Contact
            <input type="tel" class="form-control" id="contact" name="contact" class="@error('contact') is-invalid @enderror">
            @error('contact')
            <div class="alert">{{ $message }}</div>
            @enderror
        </label></br>
        <label for="profil">Photo_profil
            <input type="text" class="form-control" id="photo_profil" name="photo_profil">
        </label></br>
        <label for="ville">Ville
            <input type="text" class="form-control" id="ville" name="ville" class="@error('ville') is-invalid @enderror">
            @error('ville')
            <div class="alert">{{ $message }}</div>
            @enderror
        </label></br>
        <label for="quartier">Quartier
            <input type="text" class="form-control" id="quartier" name="quartier" class="@error('quartier') is-invalid @enderror">
            @error('quartier')
            <div class="alert">{{ $message }}</div>
            @enderror
        </label></br>
        <label for="sexe">Sexe
            <select name="sexe" id="sexe">
                <option value="Masculin">Masculin</option>
                <option value="Feminin">Feminin</option>
            </select>
        </label></br>
        <label for="statut">Statut
            <input type="text" class="form-control" id="statut" name="statut" class="@error('statut') is-invalid @enderror">
            @error('statut')
            <div class="alert">{{ $message }}</div>
            @enderror
        </label></br>
        <button type="Submit">Ajouter le personnel</button>
    </form>
</div>

