@extends('layout.ouvragePhysique.ouvragePhysiqueCreate', ['action'=>"enregistementLivrePapier", 'title'=>"Ajouter un livre papier"])
@section('particularite_papier')
    <fieldset class="border border-solid border-gray-600 p-4 space-y-3 rounded-md">
        <legend>Particularité</legend>
        <div>
            <label class="label">Catégorie</label>
            <select name="categorie" id="ajouterCategorie" class="select_btn @error('categorie0') is-invalid @enderror">
                <option>--Selectionner--</option>
                @foreach($categories as $categorie)
                    <option value="{{$categorie}}" {{ old('categorie') == $categorie ? 'selected':'' }}>{{$categorie}}</option>
                @endforeach
            </select>
            @error('categorie0')
            <div class="alert">{{ $message }}</div>
            @enderror
            <div id="listeCategorie"></div>
        </div>
        <div>
            <label class="label">ISBN</label>
            <input name="ISBN" type="text" value="{{ old('ISBN') }}" placeholder="Saisire l'ISBN de l'ouvrage"
                   class="input @error('ISBN') is-invalid @enderror">
        </div>
        @error('ISBN')
        <div class="alert">{{ $message }}</div>
        @enderror
    </fieldset>
@stop
