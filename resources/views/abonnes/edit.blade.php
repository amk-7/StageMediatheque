@extends('layouts.user.userEdit', ['action'=>'abonnes.update', 'title'=>"Modifier un abonné", 'utilisateur'=>$abonne->utilisateur, 'model'=>$abonne])

@section('abonne')
    <div class="flex flex-col md:flex-row md:space-x-3 space-y-3 md:space-y-0 mt-3">
        <div class="w-full md:w-1/2">
            <label class="label" for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" value="{{\App\Http\Controllers\Controller::afficherDate($abonne->date_naissance)}}" class="input">
        </div>
        <div class="w-full md:w-1/2">
            <label class="label" for="contact_a_prevenir">Contact à prévenir</label>
            <input type="text" name="contact_a_prevenir" value="{{ $abonne->contact_a_prevenir }}" class="input">
        </div>
    </div>

    <div class="flex flex-col md:flex-row space-y-3 md:space-y-0">
        <div class="w-full md:w-1/2">
            <label for="niveau_etude">Niveau d'étude</label>
            <div  class="label">
                <input type="radio" name="niveau_etude" value="Primaire" {{ $abonne->niveau_etude == "Primaire" ? "checked" : "" }}>
                <label>Primaire</label>
            </div>
            <div class="label">
                <input type="radio" name="niveau_etude" value="Collège" {{ $abonne->niveau_etude == "Collège" ? "checked" : "" }}>
                <label>Collège</label>
            </div>
            <div class="label">
                <input type="radio" name="niveau_etude" value="Lycée" {{ $abonne->niveau_etude == "Lycée" ? "checked" : "" }}>
                <label>Lycée</label>
            </div>
            <div class="label">
                <input type="radio" name="niveau_etude" value="Université" {{ $abonne->niveau_etude == "Université" ? "checked" : "" }}>
                <label>Université</label>
            </div>
        </div>
        <div class="w-full md:w-1/2">
            <label class="" for="profession">Profession : </label>
            <div class="label">
                <input type="radio" name="profession" value="Elève" {{ $abonne->profession == "Elève" ? "checked" : "" }}>
                <label>Elève</label>
            </div>
            <div class="label">
                <input type="radio" name="profession" value="Etudiant" {{ $abonne->profession == "Etudiant" ? "checked" : "" }}>
                <label>Etudiant</label>
            </div>
            <div class="label">
                <input type="radio" name="profession" value="Fonctionnaire" {{ $abonne->profession == "Fonctionnaire" ? "checked" : "" }}>
                <label>Fonctionnaire</label>
            </div>
            <div class="label">
                <input type="radio" name="profession" value="Retraité" {{ $abonne->profession == "Retraité" ? "checked" : "" }}>
                <label>Retraité</label>
            </div>
        </div>
    </div>

    <div>
        <label class="" for="type_de_carte">Type de carte</label>
        <div class="label">
            <input type="radio" name="type_de_carte" value="1" {{ $abonne->type_de_carte == "1" ? "checked" : "" }}>
            <label> Identité</label>
            <input type="radio" name="type_de_carte" value="0" {{ $abonne->type_de_carte == "0" ? "checked" : "" }}>
            <label> Scolaire</label>
        </div>
    </div>
    <div>
        <label class="label" for="numero_carte">Numéro de carte</label>
        <input type="text" name="numero_carte" value="{{ $abonne->numero_carte }}" class="input">
    </div>
    @if(Auth::user() && Auth::user()->hasRole('bibliothecaire'))
        <div class="flex space-x-3 mt-6">
            <label class="label" for="type_de_carte">Profil valide ?</label>
            <div class="flex space-x-3">
                <input type="radio" name="profil_valide" value="1" {{  $abonne->profil_valider == "1" ? 'checked' : '' }}>
                <label>Oui</label>
                <input type="radio" name="profil_valide" value="0" {{ $abonne->profil_valider == "0" ? 'checked' : '' }}>
                <label>Non</label>
            </div>
        </div>
    @endif
</form>
@stop
