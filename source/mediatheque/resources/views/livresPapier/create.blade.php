@extends('layout.ouvragePhysique.ouvragePhysiqueCreate', ['action'=>"enregistementLivrePapier", 'title'=>"Ajouter un livre papier"])
@section('particularite_papier')
    <fieldset>
        <legend>Particularité</legend>
        <div>
            <label>Catégorie</label>
            <select name="categorie" id="ajouterCategorie" class="@error('categorie0') is-invalid @enderror">
                <option>--Selectionner--</option>
                @foreach($categories as $categorie)
                    <option value="{{$categorie}}">{{$categorie}}</option>
                @endforeach
            </select>
            @error('categorie0')
            <div class="alert">{{ $message }}</div>
            @enderror
            <div id="listeCategorie"></div>
        </div>
        <div>
            <label>ISBN</label>
            <input name="ISBN" type="text" value="ISBN13" placeholder="Saisire l'ISBN de l'ouvrage"
                   class="@error('ISBN') is-invalid @enderror">
        </div>
        @error('ISBN')
        <div class="alert">{{ $message }}</div>
        @enderror
    </fieldset>
@stop

@section("js")
    <script type="text/javascript">
        let id_search_bar = "nom";
        let id_hidden_search_bar = "id_auteur";
        let options_class_name = "auteurs";
        let id_select_prenom = "prenom";
        let input_searche_bar = document.getElementById(id_search_bar);
        let hidden_input_searche_bar = document.getElementById(id_hidden_search_bar);
        let select_prenom = document.getElementById(id_select_prenom);


    </script>
@stop
