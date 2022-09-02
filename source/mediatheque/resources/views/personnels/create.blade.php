@extends('layout.user.userCreate', ['action'=>"storePersonnel", 'title'=>"Ajouter un personnel"])

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

