<?php ?>
<h1>Création d un nouvel Abonne</h1>
<div>
    <form method="POST" action="{{route('storeAbonne')}}">
        @csrf
        nom : <input type="text" name="nom"></br>
        prenom : <input type="text" name="prenom"></br>
        nom d'utilisateur : <input type="text" name="nom_utilisateur"></br>
        email : <input type="text" name="email"></br>
        mot de passe : <input type="password" name="password"></br>
        contact : <input type="text" name="contact"></br>
        photo profil : <input type="text" name="photo_profil"></br>
        ville : <input type="text" name="ville"></br>
        quartier : <input type="text" name="quartier"></br>
        sexe : <input type="text" name="sexe"></br>
        date Naissance  :  <input type="date" name="date_naissance"></br>
        niveau d etude  :  <input type="text" name="niveau_etude"></br>
        profession  :  <input type="text" name="profession"></br>
        contact a prevenir  :  <input type="text" name="contact_a_prevenir"></br>
        numero de carte  :  <input type="text" name="numero_carte"></br>
        type de carte  :  <input type="text" name="type_de_carte"></br>
        <button type="Submit">Ajouter l'Abonne</button>
    </form>
</div>
