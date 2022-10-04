@extends('layout.ouvrage.ouvrageEdite', ['ouvrage'=>$ouvragesPhysique->ouvrage])
@section("stock")
    <fieldset>
        <legend>Stock</legend>
        <div>
            <label>Nombre d'exemplaire</label>
            <input name="nombre_exemplaire" type="number"
                   value="{{ $ouvragesPhysique->nombre_exemplaire }}">
        </div>
        <div>
            <div>
                <label>Rayons</label>
                <select id="id_classification_dewey_centaine" name="id_classification_dewey_centaine">
                    <option>Sélectionner rayon</option>
                    @foreach($classification_dewey_centaines as $classification_dewey_centaine)
                        <option value="{{$classification_dewey_centaine->id_classification_dewey_centaine}}"
                            {{$classification_dewey_centaine->id_classification_dewey_centaine == $ouvragesPhysique->classificationDeweyDizaine->id_classification_dewey_centaine ? "selected" : ""}}>
                            {{$classification_dewey_centaine->theme}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Etagère</label>
                <select id="id_classification_dewey_dizaine" name="id_classification_dewey_dizaine">
                    <option>Sélectionner etagère</option>
                    @foreach($classification_dewey_dizaines as $classification_dewey_dizaine)
                        @if($classification_dewey_dizaine->id_classification_dewey_centaine == $livresPapier->ouvragesPhysique->classificationDeweyDizaine->id_classification_dewey_centaine)
                            <option value="{{$classification_dewey_dizaine->id_classification_dewey_dizaine}}"
                                {{$classification_dewey_dizaine->id_classification_dewey_dizaine == $ouvragesPhysique->id_classification_dewey_dizaine ? "selected" : ""}}>
                                {{$classification_dewey_dizaine->matiere}}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </fieldset>
@stop
@section('ouvrage_physique_content_js')
    @include('layout.ouvrageZJS.ouvragePhysique')
@stop
