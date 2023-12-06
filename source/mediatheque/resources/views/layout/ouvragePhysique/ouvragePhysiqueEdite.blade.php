@extends('layout.ouvrage.ouvrageEdite', ['ouvrage'=>$ouvragesPhysique->ouvrage])
@section("stock")
    <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
        <legend>Stock</legend>
        <div>
            <label class="label">Nombre d'exemplaire</label>
            <input name="nombre_exemplaire" type="number" value="{{ $ouvragesPhysique->nombre_exemplaire }}"
                class="input @error('nombre_exemplaire') is-invalid @enderror">
            @error('nombre_exemplaire')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div>
            <div>
                <label class="label">Rayons</label>
                <select id="id_classification_dewey_centaine" name="id_classification_dewey_centaine" class="select_btn">
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
                <label class="label">Etagère</label>
                <select id="id_classification_dewey_dizaine" name="id_classification_dewey_dizaine" class="select_btn">
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
        </div> --}}
    </fieldset>
@stop
@section('ouvrage_physique_content_js')
    @include('layout.ouvrageZJS.ouvragePhysique')
@stop
