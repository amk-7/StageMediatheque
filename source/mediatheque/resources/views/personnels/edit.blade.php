@extends('layout.user.userEdit', ['action'=>"updatePersonnel", 'title'=>"Modifier un personnel", 'utilisateur'=>$personnel->utilisateur, 'model'=>$personnel])

@section('personnel')

    <div>
        <label for="statut">Statut</label>
            <input type="text" name="statut" value="{{$personnel->statut}}">
    </div>
@endsection

