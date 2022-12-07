@extends('layout.user.userCreate', ['action'=>"storeAbonne", 'title'=>"Ajouter un abonné"])

@section('abonne')
    <div class="flex flex-row space-x-3">
        <div class="w-1/2">
            <label class="label" for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{old('date_naissance')}}" class="input @error('date_naissance') is-invalid @enderror">
            @error('date_naissance')
            <div class="alert">{{ $message }}</div>}
            @enderror
        </div>
        <div class="w-1/2">
            <label class="label" for="contact_a_prevenir">Contact à prévenir</label>
            <input type="text" name="contact_a_prevenir" id="contact_a_prevenir" value="{{old('contact_a_prevenir')}}" class="input @error('contact_a_prevenir') is-invalid @enderror">
            @error('contact_a_prevenir')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="flex flex-row">
        <div class="w-1/2">
            <label class="label" for="niveau_etude">Niveau d'étude : </label>
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
        <input type="text" name="numero_carte" id="numero_carte" value="{{old('numero_carte')}}"  class="input @error('numero_carte') is-invalid @enderror">
        @error('numero_carte')
        <div class="alert">{{ $message }}</div>
        @enderror
    </div>
@stop
