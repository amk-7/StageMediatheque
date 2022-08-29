<?php ?>
<h1>Création d un nouvel Abonne</h1>
<div>
    <form method="POST" action="{{route('storeAbonne')}}">
        @csrf
        <label for="nom">Nom
            <input type="text" name="nom" id="nom">
        </label></br>
        <label for="prenom">Prenom
            <input type="text" name="prenom" id="prenom">
        </label></br>
        <label for="nom_utilisateur">Nom d'utilisateur
            <input type="text" name="nom_utilisateur" id="nom_utilisateur">
        </label></br>
        <label for="email">Email
            <input type="email" name="email" id="email">
        </label></br>
        <label for="mot_de_passe">Mot de passe
            <input type="password" name="password" id="password">
        </label></br>
        <label for="contact">Contact
            <input type="tel" name="contact" id="contact">
        </label></br>
        <label for="photo_profil">Photo de profil
            <input type="text" name="photo_profil" id="photo_profil">
        </label></br>
        <label for="ville">Ville
            <input type="text" name="ville" id="ville">
        </label></br>
        <label for="quartier">Quartier
            <input type="text" name="quartier" id="quartier">
        </label></br>
        <label for="sexe">Sexe
            <select name="sexe" id="sexe">
                <option value="Masculin">Masculin</option>
                <option value="Feminin">Feminin</option>
            </select>
        </label></br>
        <label for="date_naissance">Date de naissance
            <input type="date" name="date_naissance" id="date_naissance">
        </label></br>
        <label for="niveau_etude">Niveau d'étude
            <select name="niveau_etude" id="niveau_etude">
                <option value="1er dégré">1er dégré</option>
                <option value="2è dégré">2è dégré</option>
                <option value="3è dégré">3è dégré</option>
                <option value="Université">Université</option>
            </select>
        </label></br>
        <label for="profession">Profession
            <input type="text" name="profession" id="profession">
        </label></br>
        <label for="contact_a_prevenir">Contact à prévenir
            <input type="text" name="contact_a_prevenir" id="contact_a_prevenir">
        </label></br>
        <label for="numero_carte">Numéro de carte
            <input type="text" name="numero_carte" id="numero_carte">
        </label></br>
        <label for="type_de_carte">Type de carte
            <input type="text" name="type_de_carte" id="type_de_carte">
        </label></br>
        <button type="Submit">Ajouter l'Abonne</button>
    </form>
</div>
