@extends('layout.ouvrage.ouvrageEdite', ['livresPapier'=>$livresPapier])
@section("stock")
    <fieldset>
        <legend>Stock</legend>
        <div>
            <label>Nombre d'exemplaire</label>
            <input name="nombre_exemplaire" type="number"
                   value="{{ $livresPapier->ouvragePhysique->nombre_exemplaire }}">
        </div>
        <div>
            <div>
                <label>Rayons</label>
                <select id="id_classification_dewey_centaine" name="id_classification_dewey_centaine">
                    <option>--Sélectionner--</option>
                    @foreach($classification_dewey_centaines as $classification_dewey_centaine)
                        <option value="{{$classification_dewey_centaine->id_classification_dewey_centaine}}">{{$classification_dewey_centaine->theme}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Etagère</label>
                <select id="id_classification_dewey_dizaine" name="id_classification_dewey_dizaine">
                    <option>--Sélectionner etagère--</option>
                </select>
            </div>
        </div>
    </fieldset>
@stop
