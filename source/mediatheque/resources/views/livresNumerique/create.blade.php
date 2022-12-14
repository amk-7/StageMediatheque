@extends('layout.ouvrageElectronique.ouvrageElectroniqueCreate', ['action'=>"enregistementLivreNumerique", 'methode'=>"post", 'title'=>"Ajouter un livre numérique"])
@section('particularite_numerique')
    <fieldset class="border border-solid border-gray-600 p-4 space-y-3 rounded-md">
        <legend>Particularité</legend>
        <div>
            <input type="text" id="data_categorie" name="data_categorie" hidden>
            <label class="label">Catégorie</label>
            <select name="categorie" id="ajouter_categorie" class="select_btn @error('categorie0') is-invalid @enderror">
                <option>Sélectionner categorie</option>
                @foreach($categories as $categorie)
                    <option value="{{$categorie}}" {{ old('categorie') == $categorie ? 'selected':'' }}>{{$categorie}}</option>
                @endforeach
            </select>
            @error('categorie')
            <div class="alert">{{ $message }}</div>
            @enderror
            <div id="liste_categorie"></div>
        </div>
        <div>
            <label class="label">ISBN</label>
            <input name="ISBN" type="text" value="{{ old('ISBN') }}" placeholder="Saisire l'ISBN de l'ouvrage"
                   class="input @error('ISBN') is-invalid @enderror">
        </div>
        @error('ISBN')
        <div class="alert">{{ $message }}</div>
        @enderror
    </fieldset>
@stop

