@extends('layout.user.userEdit', ['action'=>'updateAbonne', 'title'=>"Modifier un abonné", 'utilisateur'=>$abonne->utilisateur, 'model'=>$abonne])

@section('abonne')

    <div>
    <label for="date_naissance">Date de naissance</label>
        <input type="date" name="date_naissance" value="{{$abonne->date_naissance}}">
    </div>

    <div>
        <label for="niveau_etude">Niveau d'étude</label>
            <div>
                <input type="radio" name="niveau_etude" value="Primaire">Primaire
                <input type="radio" name="niveau_etude" value="Collège">Collège
                <input type="radio" name="niveau_etude" value="Lycée">Lycée
                <input type="radio" name="niveau_etude" value="Université">Université
            </div>
    </div>

    <div>
        <label class="label" for="profession">Profession : </label>
            <div>
                <input type="radio" name="profession" value="Elève">Elève</input>
                <input type="radio" name="profession" value="Etudiant">Etudiant</input>
                <input type="radio" name="profession" value="Fonctionnaire">Fonctionnaire</input>
                <input type="radio" name="profession" value="Retraité">Retraité</input>
            </div>
    </div>

    <div>
    <label for="contact_a_prevenir">Contact à prévenir</label>
        <input type="text" name="contact_a_prevenir" value="{{ $abonne->contact_a_prevenir }}">
    </div>

    <div>
        <label for="type_de_carte">Type de carte</label>
            <div>
                <input type="radio" name="type_de_carte" value="Identité">Identité
                <input type="radio" name="type_de_carte" value="Scolaire">Scolaire
            </div>
    </div>

    <div>
    <label for="numero_carte">Numéro de carte</label>
        <input type="text" name="numero_carte" value="{{ $abonne->numero_carte }}">
    </div>
</form>
@stop