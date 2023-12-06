@extends('layout.ouvragePhysique.ouvragePhysiqueEdite', ['update_object'=>$livresPapier, 'ouvragesPhysique'=>$livresPapier->ouvragesPhysique, 'action'=>"modificationLivrePapier"])
@section("particularite")
    <fieldset class="border border-solid border-gray-600 p-4 space-y-3 rounded-md">
        <legend>Particularité</legend>
        <div>
            <label>Catégorie</label>
            <input type="text" name="data_categorie" id="data_categorie" hidden>
            <select name="categorie" id="ajouter_categorie" class="select_btn @error('categorie0') is-invalid @enderror">
                <option>Sélectionner categorie</option>
                @foreach($categories as $categorie)
                    <option value="{{$categorie}}">{{$categorie}}</option>
                @endforeach
            </select>
            <div id="liste_categorie" class="flex space-x-3 mt-3">
                @foreach($livresPapier->categorie as $categorie)
                    @if(! empty($categorie))
                    <input class="input_elt" type="text" name="categorie{{$loop->index}}" id="categorie{{$loop->index}}" value="{{ $categorie }}" disabled/>
                    <button type="button" class="button button_delete" onclick="removeElt('liste_categorie','categorie{{$loop->index}}')">supprimer</button>
                    @endif
                @endforeach
            </div>
        </div>
        <div>
            <label>ISBN</label>
            <input class="input @error('ISBN') is-invalid @enderror" name="ISBN" type="text" value=" {{ $livresPapier->ISBN }}" placeholder="Saisire l'ISBN de l'ouvrage">
        </div>
    </fieldset>
@stop

