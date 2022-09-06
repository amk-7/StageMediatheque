@extends('layout.base')

@section('content')

<style>
    td, th {border: 2px solid black;}

    caption {background-color: deepskyblue;}

    label {background-color: red;}

    th {background-color: chartreuse;}

    td {background-color: burlywood;}
</style>

<form method="GET" action="{{route($action, $model)}}">
    <table>
        <caption>{{$title}}</caption>
        <tr>
            <th>Identifiant de l'utilisateur :</th>
            <th>Nom :</th>
            <th>Prenom :</th>
            <th>Nom d'utilisateur :</th>
            <th>Email :</th>
            <th>Contact :</th>
            <th>Photo_profil :</th>
            <th>Ville :</th>
            <th>Quartier :</th>
            <th>Sexe :</th>
        </tr>
        <tr>
            <td>{{$utilisateur->id_utilisateur}}</td>
            <td>{{$utilisateur->nom}}</td>
            <td>{{$utilisateur->prenom}}</td>
            <td>{{$utilisateur->nom_utilisateur}}</td>
            <td>{{$utilisateur->email}}</td>
            <td>{{$utilisateur->contact}}</td>
            <td>{{$utilisateur->photo_profil}}</td>
            <td>{{$utilisateur->adresse["ville"]}}</td>
            <td>{{$utilisateur->adresse["quartier"]}}</td>
            <td>{{$utilisateur->sexe}}</td>
        </tr>

        @yield('abonne')
        @yield('personnel')

    
    </table>
</form>