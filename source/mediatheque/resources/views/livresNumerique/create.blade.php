@extends('layout.ouvrageElectronique.ouvrageElectroniqueCreate', ['action'=>"enregistementLivreNumerique", 'methode'=>"post", 'title'=>"Ajouter un livre numérique"])
@section('particularite_numerique')
    <fieldset>
        <legend>Particularité</legend>
        <div>
            <label>Catégorie</label>
            <select name="categorie">
                @foreach($categories as $categorie)
                    <option value="{{$categorie}}">{{$categorie}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>ISBN</label>
            <input name="ISBN" type="text" value="" placeholder="Saisire l'ISBN de l'ouvrage">
        </div>
    </fieldset>
@stop
