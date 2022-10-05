@extends('layout.user.userCreate', ['action'=>"storePersonnel", 'title'=>"Ajouter un personnel"])

@section('personnel')


    <div>
        <label class="label" for="statut">Statut : </label>
        <div class="flex space-x-3">
            <div class="flex space-x-1">
                <input type="radio" name="statut" value="Bibliothècaire"/>
                <label class="label">Bibliothècaire</label>
            </div>
            <div class="flex space-x-1">
                <input type="radio" name="statut" value="Responsable"/>
                <label class="label">Responsable</label>
            </div>
        </div>
    </div>
@endsection

