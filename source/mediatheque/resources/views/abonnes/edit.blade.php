<?php
?>
<title>Mise à jour d'un Abonne</title>
<h1> Modifier les informations d'un Abonne </h1>
<form action="{{ route('updateAbonne', $abonne) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <label for="date_naissance">Date de naissance
        <input type="date" name="date_naissance" value="{{ $abonne->date_naissance }}">
    </label></br>
    <label for="niveau_etude">Niveau d'étude
        <select name="niveau_etude" id="niveau_etude">
            <option value="1er dégré">1er dégré</option>
            <option value="2è dégré">2è dégré</option>
            <option value="3è dégré">3è dégré</option>
            <option value="Université">Université</option>
        </select>

    </label></br>
    <div class="form-group">
        <label for="profession">profession</label>
        <input type="text" class="form-control" id="profession" name="profession" value="{{ $abonne->profession }}">
    </div>
    <label for="contact_a_prevenir">Contact à prévenir
        <input type="text" name="contact_a_prevenir" value="{{ $abonne->contact_a_prevenir }}">
    </label></br>
    <label for="numero_carte">Numéro de carte
        <input type="text" name="numero_carte" value="{{ $abonne->numero_carte }}">
    </label></br>
    <label for="type_de_carte">Type de carte
        <input type="text" name="type_de_carte" value="{{ $abonne->type_de_carte }}">
    </label></br>
    <div class="form-group">
        <label for="Modification"> Valider les modifications </label>
        <input type="submit" class="btn btn-primary" value="Modifier">
    </div>
</form>