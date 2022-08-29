@extends('layout.ouvrage.ouvragePhysique.ouvragePhysiqueCreate', [
    'action'=>"enregistementDocumentAudioVisuels",
    'title'=>"Ajouter un document audio visuel"
    ])
@section('particularite_document')
    <fieldset>
        <legend>Particularité</legend>
        <div>
            <label>genre</label>
            <select name="genre" id="ajouterGenre">
                <option>--Selectionner genre--</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre }}">{{ $genre }}</option>
                @endforeach
            </select>
            <div id="listeGenre"></div>
        </div>
        <div>
            <label>ISAN</label>
            <input name="ISAN" type="text" value="" placeholder="Saisire l'ISBN de l'ouvrage">
        </div>
    </fieldset>
@stop

