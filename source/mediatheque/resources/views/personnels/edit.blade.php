@extends('layout.user.userEdit', ['action'=>"updatePersonnel", 'title'=>"Modifier un personnel", 'utilisateur'=>$personnel->utilisateur, 'model'=>$personnel])

@section('personnel')

    <div>
        <label for="statut">Statut : </label>
            <div>
                    <input type="radio" name="statut" value="Bibliothècaire">Bibliothècaire</br>
                    <input type="radio" name="statut" value="Directeur">Directeur</br>
                    <input type="radio" name="statut" value="Directeur Général">Directeur Général</br>
                    <input type="radio" name="statut" value="-------">-------</br>
            </div>
    </div>
@endsection

