<?php ?>
<style>
    td, th {border: 2px solid black;}

    caption {background-color: deepskyblue;}

    label {background-color: red;}

    th {background-color: chartreuse;}

    td {background-color: burlywood;}
</style>

<h1>Liste du Personnels</h1>
<form method="GET" action="{{route('createPersonnel')}}">
        <button type="Submit">Ajouter un Personnel</button>
    </form>
<div>
    <table>
        <caption>Informations sur les Personnels</caption>
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
            <th> Statut </th>
            <th> Action </th>
        </tr>
    @forelse ($listePersonnels as $personnel)
            <tr>
                <td>{{$personnel->utilisateur->id_utilisateur}}</td>
                <td>{{$personnel->utilisateur->nom}}</td>
                <td>{{$personnel->utilisateur->prenom}}</td>
                <td>{{$personnel->utilisateur->nom_utilisateur}}</td>
                <td>{{$personnel->utilisateur->email}}</td>
                <td>{{$personnel->utilisateur->contact}}</td>
                <td>{{$personnel->utilisateur->photo_profil}}</td>
                <td>{{$personnel->utilisateur->adresse["ville"]}}</td>
                <td>{{$personnel->utilisateur->adresse["quartier"]}}</td>
                <td>{{$personnel->utilisateur->sexe}}</td>
                <td>{{$personnel->statut}}</td>
                <td>
                    <form method="GET" action="{{route('editPersonnel', $personnel)}}">
                        <button type="Submit">Modifier</button>
                    </form>

                    <form methode="GET" action="{{route('showPersonnel', $personnel)}}">
                        <button type="Submit">Afficher</button>
                    </form>

                    <form method="POST" action="{{route('destroyPersonnel', $personnel)}}">
                        @csrf
                        @method("DELETE")
                        <button type="Submit">Supprimer</button>
                    </form>
                </td>
            </tr>
    @empty
        <span>Aucun personnel n'a été trouvé</span>
    @endforelse
    </table>
    {{--$listePersonnels->links()--}}
</div>