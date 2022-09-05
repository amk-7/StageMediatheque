@extends('layout.user.userCreate', ['action'=>"storePersonnel", 'title'=>"Ajouter un personnel"])

@section('personnel')


    <div>
        <label for="statut">Statut : </label>
            <div>
                    <input type="radio" name="statut" value="Bibliothècaire">Bibliothècaire</br>
                    <input type="radio" name="statut" value="Responsable">Responsable</br>
            </div>
    </div>
@endsection

