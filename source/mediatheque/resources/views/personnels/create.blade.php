<?php ?>
<h1>Création d'un nouvel personnel</h1>
<div>
    <form method="POST" action="{{route('storePersonnel')}}">
        @csrf
        <label for="nom">Nom
            <input type="text" class="form-control" id="nom" name="nom">
        </label></br>
        <label for="prenom">Prenom
            <input type="text" class="form-control" id="prenom" name="prenom">
        </label></br>
        <label for="nom_utilisateur">Nom d'utilisateur
            <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur">
        </label></br>
        <label for="email">Email
            <input type="text" class="form-control" id="email" name="email">
        </label></br>
        <label for="password">Mot de passe
            <input type="password" class="form-control" id="password" name="password">
        </label></br>
        <label for="contact">Contact
            <input type="text" class="form-control" id="contact" name="contact">
        </label></br>
        <label for="profil">Photo_profil
            <input type="text" class="form-control" id="photo_profil" name="photo_profil">
        </label></br>
        <label for="ville">Ville
            <input type="text" class="form-control" id="ville" name="ville">
        </label></br>
        <label for="quartier">Quartier
            <input type="text" class="form-control" id="quartier" name="quartier">
        </label></br>
        <label for="sexe">Sexe
            <select name="sexe" id="sexe">
                <option value="Masculin">Masculin</option>
                <option value="Feminin">Feminin</option>
            </select>
        </label></br>
        <label for="statut">Statut
            <input type="text" class="form-control" id="statut" name="statut">
        </label></br>
        <button type="Submit">Ajouter le personnel</button>
    </form>
</div>