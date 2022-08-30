@extends('layout.ouvrage.ouvrageCreate')
@section('stock')
    <fieldset>
        <legend>Stock</legend>
        <div>
            <label>Nombre d'exemplaire</label>
            <input name="nombre_exemplaire" type="number" value="13"
                   class="@error('nombre_exemplaire') is-invalid @enderror">
            @error('nombre_exemplaire')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>Etat</label>
            <select id="etat" name="etat" class="@error('etat') is-invalid @enderror">
                @for ($i = 5; $i > 0; $i--)
                    <option value="{{ $i }}">{{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }}</option>
                @endfor
            </select>
            @error('etat')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>Emplacement</label>
            <div>
                <label>Rayons</label>
                <select id="id_classification_dewey_centaine" name="id_classification_dewey_centaine"
                        onchange="etagerData({!! $classification_dewey_dizaines  !!})"
                        class="@error('id_classification_dewey_centaine') is-invalid @enderror">
                    <option>--Selectionner--</option>
                    @foreach($classification_dewey_centaines as $classification_dewey_centaine)
                        <option
                            value="{{$classification_dewey_centaine->id_classification_dewey_centaine}}">{{$classification_dewey_centaine->theme}}</option>
                    @endforeach
                </select>
                @error('id_classification_dewey_centaine')
                <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label>Etagère</label>
                <select id="id_classification_dewey_dizaine" name="id_classification_dewey_dizaine"
                        class="@error('id_classification_dewey_dizaine') is-invalid @enderror">
                    <option>--Selectionner--</option>
                </select>
                @error('id_classification_dewey_dizaine')
                <div class="alert">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </fieldset>
    @include("layout.ouvrage.ouvrageData")
@stop