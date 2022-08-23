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
                <select name="id_classification_dewey_centaine">
                    @foreach($classification_dewey_centaines as $classification_dewey_centaine)
                        <option>{{$classification_dewey_centaine->theme}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Etagère</label>
                <select name="id_classification_dewey_centaine">
                    @foreach($classification_dewey_dizaines as $classification_dewey_dizaine)
                        <option>{{$classification_dewey_dizaine->matiere}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </fieldset>
@stop
