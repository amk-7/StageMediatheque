@extends('layout.user.userShow', ['action'=>"showAbonne", 'title'=>"Afficher un abonne", 'utilisateur'=>$abonne->utilisateur, 'model'=>$abonne])

@section('abonne')

        <label> Date Naissance : {{$abonne->date_naissance->format('d/m/Y')}}</label></br>
        <label> Niveau Etude : {{$abonne->niveau_etude}}</label></br>
        <label> Profession : {{$abonne->profession}}</label></br>
        <label> Contact à prevenir : {{$abonne->contact_a_prevenir}}</label></br>
        <label> Numero Carte : {{$abonne->numero_carte}}</label></br>
        <label> Type de Carte : {{$abonne->type_de_carte}}</label></br>


@endsection