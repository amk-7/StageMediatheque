
@extends('layout.ouvragePhysique', ['action'=>"enregistementLivrePapier", 'methode'=>"post", 'title'=>"Ajouter un livre papier"])
@section('particularite')
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

