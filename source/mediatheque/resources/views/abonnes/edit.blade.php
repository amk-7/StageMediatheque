@extends('layout.user.userEdit', ['action'=>'updateAbonne', 'title'=>"Modifier un abonné", 'utilisateur'=>$abonne->utilisateur, 'model'=>$abonne])

@section('abonne')

    <div>
    <label for="date_naissance">Date de naissance</label>
        <input type="date" name="date_naissance" value="{{ $abonne->date_naissance }}">
    </div>

    <div>
    <label for="niveau_etude">Niveau d'étude</label>
        <select name="niveau_etude" id="niveau_etude">
            <option value="1er dégré">1er dégré</option>
            <option value="2è dégré">2è dégré</option>
            <option value="3è dégré">3è dégré</option>
            <option value="Université">Université</option>
        </select>
    </div>

    <div>
        <label for="profession">profession</label>
        <input type="text" class="form-control" id="profession" name="profession" value="{{ $abonne->profession }}">
    </div>

    <div>
    <label for="contact_a_prevenir">Contact à prévenir</label>
        <input type="text" name="contact_a_prevenir" value="{{ $abonne->contact_a_prevenir }}">
    </div>

    <div>
    <label for="numero_carte">Numéro de carte</label>
        <input type="text" name="numero_carte" value="{{ $abonne->numero_carte }}">
    </div>

    <div>
    <label for="type_de_carte">Type de carte
        <input type="text" name="type_de_carte" value="{{ $abonne->type_de_carte }}">
    </label></br>
    </div>
</form>
@endsection