@extends('layout.user.userShow', ['action'=>"showPersonnel", 'title'=>"Afficher un personnel", 'utilisateur'=>$personnel->utilisateur, 'model'=>$personnel])

@section('personnel')

    <label>
        <span>Statut : </span>
        <span>{{$personnel->statut}}</span>
    </label></br>

@endsection