@extends('layout.ouvrage.ouvrageCreate')
@section('stock')
    <fieldset class="border border-solid border-gray-600 p-4 rounded-md">
        <legend>Stock</legend>
        <div>
            <label class="label">Nombre d'exemplaire</label>
            <input name="nombre_exemplaire" type="number" value="{{ old('nombre_exemplaire') }}"
                   class="input @error('nombre_exemplaire') is-invalid @enderror">
            @error('nombre_exemplaire')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex flex-row space-x-3 mt-2">
            <div class="flex flex-col">
                <label class="label">Rayons</label>
                <select id="id_classification_dewey_centaine" name="id_classification_dewey_centaine"
                        class="select_btn @error('id_classification_dewey_centaine') is-invalid @enderror">
                    <option>Selectionner rayon</option>
                    @foreach($classification_dewey_centaines as $classification_dewey_centaine)
                        <option
                            value="{{$classification_dewey_centaine->id_classification_dewey_centaine}}" {{ old('id_classification_dewey_centaine') == $classification_dewey_centaine->id_classification_dewey_centaine ? 'selected':'' }} >
                            {{$classification_dewey_centaine->theme}}
                        </option>
                    @endforeach
                </select>
                @error('id_classification_dewey_centaine')
                <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col">
                <label class="label">Etagère</label>
                <select id="id_classification_dewey_dizaine" name="id_classification_dewey_dizaine"
                        class="select_btn @error('id_classification_dewey_dizaine') is-invalid @enderror">
                    <option>Selectionner étagère</option>
                </select>
                @error('id_classification_dewey_dizaine')
                <div class="alert">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </fieldset>
@stop
@section('ouvrage_physique_content_js')
    @include('layout.ouvrageZJS.ouvragePhysique')
@stop
