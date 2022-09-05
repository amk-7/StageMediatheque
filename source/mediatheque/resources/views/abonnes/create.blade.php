@extends('layout.user.userCreate', ['action'=>"storeAbonne", 'title'=>"Ajouter un abonné"])

@section('abonne')
    
    <div>    
        <label for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{old('date_naissance')}}" class="@error('date_naissance') is-invalid @enderror">
            @error('date_naissance')
                <div class="alert">{{ $message }}</div>}
            @enderror
    </div>

    <div>
        <label for="niveau_etude">Niveau d'étude : </label>
            <div>
                <input type="radio" name="niveau_etude" value="Primaire">Primaire</br>
                <input type="radio" name="niveau_etude" value="Collège">Collège</br>
                <input type="radio" name="niveau_etude" value="Lycée">Lycée</br>
                <input type="radio" name="niveau_etude" value="Université">Université</br>
            </div>
    </div>

    <div>
        <label for="profession">Profession : </label>
            <div>
                <input type="radio" name="profession" value="Elève">Elève</br>
                <input type="radio" name="profession" value="Etudiant">Etudiant</br>
                <input type="radio" name="profession" value="Fonctionnaire">Fonctionnaire</br>
                <input type="radio" name="profession" value="Retraité">Retraité</br>
            </div>
    </div>

    <div>
        <label for="contact_a_prevenir">Contact à prévenir</label>
            <input type="text" name="contact_a_prevenir" id="contact_a_prevenir" value="{{old('contact_a_prevenir')}}" class="@error('contact_a_prevenir') is-invalid @enderror">
            @error('contact_a_prevenir')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="type_de_carte">Type de carte :</label>
            <div>
                <input type="radio" name="type_de_carte" value="Identité">Identité</br>
                <input type="radio" name="type_de_carte" value="Scolaire">Scolaire</br>
            </div>
    </div>

    <div>
        <label for="numero_carte">Numéro de carte</label>
            <input type="text" name="numero_carte" id="numero_carte" value="{{old('numero_carte')}}"  class="@error('numero_carte') is-invalid @enderror">
            @error('numero_carte')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>



@endsection
