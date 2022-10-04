@extends('layout.user.userCreate', ['action'=>"storePersonnel", 'title'=>"Ajouter un personnel"])

@section('personnel')


    <div>
        <label class="label" for="statut">Statut : </label>
            <div>
                    <input type="radio" name="statut" value="Bibliothècaire">Bibliothècaire</input>
                    <input type="radio" name="statut" value="Responsable">Responsable</input>
            </div>
    </div>
@endsection

