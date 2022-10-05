@extends('layout.user.userEdit', ['action'=>"updatePersonnel", 'title'=>"Modifier un personnel", 'utilisateur'=>$personnel->utilisateur, 'model'=>$personnel])

@section('personnel')

    <div>
        <label for="statut" class="label">Statut : </label>
        <div class="flex space-x-3">
            <div class="flex space-x-1">
                <input type="radio" name="statut" value="Bibliothècaire" {{ $personnel->statut=="Bibliothècaire" ? "checked" : "" }}/>
                <label class="label">Bibliothècaire</label>
            </div>
            <div class="flex space-x-1">
                <input type="radio" name="statut" value="Responsable" {{ $personnel->statut=="Responsable" ? "checked" : "" }}/>
                <label class="label">Responsable</label>
            </div>
        </div>
    </div>
@endsection

