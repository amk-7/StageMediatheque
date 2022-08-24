@extends('layout.ouvrage.ouvrageCreate')
@section('stock')
    <fieldset>
        <legend>Stock</legend>
        <div>
            <label>Nombre d'exemplaire</label>
            <input name="nombre_exemplaire" type="number" value="">
        </div>
        <div>
            <label>Etat</label>
            <input name="etat" type="text" value="">
        </div>
        <div>
            <label>Emplacement</label>
            <div>
                <label>Rayons</label>
                <select id="id_classification_dewey_centaine" name="id_classification_dewey_centaine">
                    <option>--Selectionner--</option>
                    @foreach($classification_dewey_centaines as $classification_dewey_centaine)
                        <option>{{$classification_dewey_centaine->theme}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Etagère</label>
                <select id="id_classification_dewey_dizaine" name="id_classification_dewey_dizaine">
                </select>
            </div>
        </div>
    </fieldset>
@stop
