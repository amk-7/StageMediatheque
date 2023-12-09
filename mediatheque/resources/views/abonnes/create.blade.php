@extends('layouts.user.userCreate', ['action'=>"storeAbonne", 'title'=>"Ajouter un abonné"])

@section('abonne')
    <div class="flex flex-row space-x-3">
        <div class="w-1/2">
            <label class="label" for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{old('date_naissance')}}" class="input @error('date_naissance') is-invalid @enderror">
            @error('date_naissance')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="w-1/2">
            <label class="label" for="contact_a_prevenir">Contact à prévenir <span class="optionnel">(optionnel)</span> </label>
            <input type="text" name="contact_a_prevenir" id="contact_a_prevenir" value="{{old('contact_a_prevenir')}}" class="input">
        </div>
    </div>
    <div class="flex flex-row">
        <div class="w-1/2">
            <label class="label" for="niveau_etude">Niveau d'étude : </label>
            <div  class="label">
                <input type="radio" name="niveau_etude" value="Primaire" {{ old('niveau_etude') == "Primaire" ? 'checked' : '' }}>
                <label>Primaire</label>
            </div>
            <div class="label">
                <input type="radio" name="niveau_etude" value="Collège" {{ old('niveau_etude') == "Collège" ? 'checked' : '' }}>
                <label>Collège</label>
            </div>
            <div class="label">
                <input type="radio" name="niveau_etude" value="Lycée" {{ old('niveau_etude') == "Lycée" ? 'checked' : '' }}>
                <label>Lycée</label>
            </div>
            <div class="label">
                <input type="radio" name="niveau_etude" value="Université" {{ old('niveau_etude') == "Université" ? 'checked' : '' }}>
                <label>Université</label>
            </div>
        </div>
        <div class="w-1/2">
            <label class="label" for="profession">Profession : </label>
            <div class="label">
                <input type="radio" name="profession" value="Elève" {{ old('profession') == "Elève" ? 'checked' : '' }}>
                <label>Elève</label>
            </div>
            <div class="label">
                <input type="radio" name="profession" value="Etudiant" {{ old('profession') == "Etudiant" ? 'checked' : '' }}>
                <label>Etudiant</label>
            </div>
            <div class="label">
                <input type="radio" name="profession" value="Fonctionnaire" {{ old('profession') == "Fonctionnaire" ? 'checked' : '' }}>
                <label>Fonctionnaire</label>
            </div>
            <div class="label">
                <input type="radio" name="profession" value="Retraité" {{ old('profession') == "Retraité" ? 'checked' : '' }}>
                <label>Retraité</label>
            </div>
        </div>
    </div>
    <div>
        <label class="label" for="type_de_carte">Type de carte</label>
        <div class="label">
            <input type="radio" name="type_de_carte" value="1" {{ old('type_de_carte') == "1" ? 'checked' : '' }}>
            <label> Identité</label>
            <input type="radio" name="type_de_carte" value="0" {{ old('type_de_carte') == "0" ? 'checked' : '' }}>
            <label> Scolaire</label>
        </div>
        @error('type_de_carte')
        <div class="alert">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label class="label" for="numero_carte">Numéro de carte</label>
        <input type="text" name="numero_carte" id="numero_carte" value="{{old('numero_carte')}}"  class="input @error('numero_carte') is-invalid @enderror">
        @error('numero_carte')
        <div class="alert">{{ $message }}</div>
        @enderror
    </div>
    @if(! Auth::guest())
        <div class="flex space-x-3 mt-6">
            <label class="label" for="type_de_carte">Profil valide ?</label>
            <div class="flex space-x-3">
                <input type="radio" name="profil_valide" value="1" {{ old('profil_valide') == "1" ? 'checked' : '' }}>
                <label>Oui</label>
                <input type="radio" name="profil_valide" value="0" {{ old('profil_valide') == "0" ? 'checked' : '' }}>
                <label>Non</label>
            </div>
        </div>
    @endif
@stop
