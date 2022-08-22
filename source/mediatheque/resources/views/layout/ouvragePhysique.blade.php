@extends('layout.ouvrage')
@section('stock')
    <fieldset>
        <legend>Stock</legend>
        <div>
            <label>Nombre d'exemplaire</label>
            <input name="nombre_exemplaire" type="number" value="" >
        </div>
        <div>
            <label>Etat</label>
            <input name="etat" type="text" value="" >
        </div>
        <div>
            <label>Emplacement</label>
            <input name="id_classification_dewey_centaine" type="text" value="" >
        </div>
    </fieldset>
@stop
