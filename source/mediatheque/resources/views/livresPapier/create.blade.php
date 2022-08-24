@extends('layout.ouvragePhysique.ouvragePhysiqueCreate', ['action'=>"enregistementLivrePapier", 'methode'=>"post", 'title'=>"Ajouter un livre papier"])
@section('particularite_papier')
    <fieldset>
        <legend>Particularité</legend>
        <div>
            <label>Catégorie</label>
            <select name="categorie" id="ajouterCategorie">
                <option>--Selectionner--</option>
                @foreach($categories as $categorie)
                    <option value="{{$categorie}}">{{$categorie}}</option>
                @endforeach
            </select>
            <div id="listeCategorie"></div>
        </div>
        <div>
            <label>ISBN</label>
            <input name="ISBN" type="text" value="" placeholder="Saisire l'ISBN de l'ouvrage">
        </div>
    </fieldset>
@stop

