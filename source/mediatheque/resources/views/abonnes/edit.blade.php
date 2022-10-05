@extends('layout.user.userEdit', ['action'=>'updateAbonne', 'title'=>"Modifier un abonné", 'utilisateur'=>$abonne->utilisateur, 'model'=>$abonne])

@section('abonne')

    <div class="flex flex-row space-x-3">
        <div>
            <label class="label" for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" value="{{$abonne->date_naissance}}" class="input">
        </div>
        <div>
            <label class="label" for="contact_a_prevenir">Contact à prévenir</label>
            <input type="text" name="contact_a_prevenir" value="{{ $abonne->contact_a_prevenir }}" class="input">
        </div>
    </div>

    <div class="flex flex-row">
        <div class="w-1/2">
            <label for="niveau_etude">Niveau d'étude</label>
                <div  class="label">
                    <input type="radio" name="niveau_etude" value="Primaire">
                    <label>Primaire</label>
                </div>
                <div class="label">
                    <input type="radio" name="niveau_etude" value="Collège">
                    <label>Collège</label>
                </div>
                <div class="label">
                    <input type="radio" name="niveau_etude" value="Lycée">
                    <label>Lycée</label>
                </div>
                <div class="label">
                    <input type="radio" name="niveau_etude" value="Université">
                    <label>Université</label>
                </div>
        </div>

        <div class="w-1/2">
            <label class="label" for="profession">Profession : </label>
                <div class="label">
                    <input type="radio" name="profession" value="Elève">
                    <label>Elève</label>
                </div>
                <div class="label">
                    <input type="radio" name="profession" value="Etudiant">
                    <label>Etudiant</label>
                </div>
                <div class="label">
                    <input type="radio" name="profession" value="Fonctionnaire">
                    <label>Fonctionnaire</label>
                </div>
                <div class="label">
                    <input type="radio" name="profession" value="Retraité">
                    <label>Retraité</label>
                </div>
        </div>
    </div>

    <div>
        <label class="label" for="type_de_carte">Type de carte</label>
            <div class="label">
                <input type="radio" name="type_de_carte" value="Identité">
                <label> Identité</label>
                <input type="radio" name="type_de_carte" value="Scolaire">
                <label> Scolaire</label>
            </div>
    </div>

    <div>
    <label class="label" for="numero_carte">Numéro de carte</label>
        <input type="text" name="numero_carte" value="{{ $abonne->numero_carte }}" class="input">
    </div>
</form>
@stop