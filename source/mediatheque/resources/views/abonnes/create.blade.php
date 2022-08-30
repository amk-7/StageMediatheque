@extends('layout.user.userCreate', ['action'=>"storeAbonne", 'title'=>"Ajouter un abonné"])

@section('abonne')
    
    <div>    
        <label for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" class="@error('date_naissance') is-invalid @enderror">
            @error('date_naissance')
                <div class="alert">{{ $message }}</div>
            @enderror
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
        <label for="profession">Profession</label>
            <input type="text" name="profession" id="profession" class="@error('profession') is-invalid @enderror">
            @error('profession')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>
    
    <div>
        <label for="contact_a_prevenir">Contact à prévenir</label>
            <input type="text" name="contact_a_prevenir" id="contact_a_prevenir" class="@error('contact_a_prevenir') is-invalid @enderror">
            @error('contact_a_prevenir')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="numero_carte">Numéro de carte</label>
            <input type="text" name="numero_carte" id="numero_carte" class="@error('numero_carte') is-invalid @enderror">
            @error('numero_carte')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

    <div>
        <label for="type_de_carte">Type de carte</label>
            <input type="text" name="type_de_carte" id="type_de_carte" class="@error('type_de_carte') is-invalid @enderror">
            @error('type_de_carte')
                <div class="alert">{{ $message }}</div>
            @enderror
    </div>

@endsection
