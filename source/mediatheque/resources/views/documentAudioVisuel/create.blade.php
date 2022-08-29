@extends('layout.ouvragePhysique.ouvragePhysiqueCreate', ['action'=>"enregistementLivrePapier", 'methode'=>"post", 'title'=>"Ajouter un livre papier"])
@section('particularite')
    <fieldset>
        <legend>Particularité</legend>
        <div>
            <label>genre</label>
            <select name="genre">
                @foreach($genres as $genre)
                    <option value="{{ $genre }}">{{ $genre }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>ISBN</label>
            <input name="ISAN" type="text" value="" placeholder="Saisire l'ISBN de l'ouvrage">
        </div>
    </fieldset>
@stop

