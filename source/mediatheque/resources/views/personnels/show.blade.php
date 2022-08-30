@extends('layout.user.userShow', ['action'=>"showPersonnel", 'title'=>"Afficher un personnel", 'utilisateur'=>$personnel->utilisateur, 'model'=>$personnel])

@section('personnel')
    <label>Statut : {{$personnel->statut}}</label></br>

  
@endsection