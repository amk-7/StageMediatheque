@extends('layout.user.userEdit', ['action'=>"updatePersonnel", 'title'=>"Modifier un personnel", 'utilisateur'=>$personnel->utilisateur, 'model'=>$personnel])

@section('personnel')

    <div>
        <label for="statut">Statut : </label>
            <div>
                    <input type="radio" name="statut" value="Bibliothècaire">Bibliothècaire</br>
                    <input type="radio" name="statut" value="Responsable">Responsable</br>

            </div>
    </div>
@endsection

