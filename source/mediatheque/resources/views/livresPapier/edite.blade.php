@extends('layout.ouvragePhysique.ouvragePhysiqueEdite', ['livresPapier'=>$livresPapier, 'action'=>"modificationLivrePapier"])
@section("particularite")
    <fieldset>
        <legend>Particularité</legend>
        <div>
            <label>Catégorie</label>
            <input type="text" name="data_categorie" id="data_categorie" hidden>
            <select name="categorie" id="ajouter_categorie">
                <option>Sélectionner categorie</option>
                @foreach($categories as $categorie)
                    <option value="{{$categorie}}">{{$categorie}}</option>
                @endforeach
            </select>
            <div id="liste_categorie">
                @foreach($livresPapier->categorie as $categorie)
                    @if(! empty($categorie))
                        <input id="categorie{{$loop->index}}" type="text" name="categorie{{$loop->index}}"
                               value="{{ $categorie }}" disabled/>
                        <button onclick="removeElt('liste_categorie','categorie{{$loop->index}}')">x</button>
                    @endif
                @endforeach
            </div>
        </div>
        <div>
            <label>ISBN</label>
            <input name="ISBN" type="text" value=" {{ $livresPapier->ISBN }}" placeholder="Saisire l'ISBN de l'ouvrage">
        </div>
    </fieldset>
@stop

