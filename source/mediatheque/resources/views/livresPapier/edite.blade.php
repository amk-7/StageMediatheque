@extends('layout.ouvragePhysique.ouvragePhysiqueEdite', ['update_object'=>$livresPapier, 'ouvragesPhysique'=>$livresPapier->ouvragesPhysique, 'action'=>"modificationLivrePapier"])
@section("particularite")
    <fieldset>
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
            <div id="liste_categorie">
                @foreach($livresPapier->categorie as $categorie)
                    @if(! empty($categorie))
                        <input class="input_elt" id="categorie{{$loop->index}}" type="text" name="categorie{{$loop->index}}"
                               value="{{ $categorie }}" disabled/>
                        <button class="button button_delete" onclick="removeElt('liste_categorie','categorie{{$loop->index}}')">x</button>
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

