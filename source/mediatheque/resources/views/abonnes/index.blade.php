<?php ?>
<style>
    td, th {border: 2px solid black;}

    caption {background-color: deepskyblue;}

    label {background-color: red;}

    th {background-color: chartreuse;}

    td {background-color: burlywood;}
</style>

<h1>Liste des Abonnes</h1>
<form method="GET" action="{{route('createAbonne')}}">
    <button type="Submit">Ajouter un Abonne</button>
</form>
<div>
    <table>
        <caption>Informations sur les Abonnes</caption>
        <tr>
            <th>Identifiant de l'utilisateur :</th>
            <th>Nom :</th>
            <th>Prenom :</th>
            <th>Nom d'utilisateur :</th>
            <th>Email :</th>
            <th>Contact :</th>
            <th>Photo de profil :</th>
            <th>Ville :</th>
            <th>Quartier :</th>
            <th>Sexe :</th>
            <th>Date Naissance</th>
            <th>Niveau Etude</th>
            <th>Profession</th>
            <th>Contact a prevenir</th>
            <th>Numero de Carte</th>
            <th>Type de Carte</th>
            <th>Action</th>
        </tr>
    @forelse ($listeAbonnes as $abonne)
            <tr>
                <td>{{$abonne->utilisateur->id_utilisateur}}</td>
                <td>{{$abonne->utilisateur->nom}}</td>
                <td>{{$abonne->utilisateur->prenom}}</td>
                <td>{{$abonne->utilisateur->nom_utilisateur}}</td>
                <td>{{$abonne->utilisateur->email}}</td>
                <td>{{$abonne->utilisateur->contact}}</td>
                <td>{{$abonne->utilisateur->photo_profil}}</td>
                <td>{{$abonne->utilisateur->adresse["ville"]}}</td>
                <td>{{$abonne->utilisateur->adresse["quartier"]}}</td>
                <td>{{$abonne->utilisateur->sexe}}</td>
                <td>{{$abonne->date_naissance}}</td>
                <td>{{$abonne->niveau_etude}}</td>
                <td>{{$abonne->profession}}</td>
                <td>{{$abonne->contact_a_prevenir}}</td>
                <td>{{$abonne->numero_carte}}</td>
                <td>{{$abonne->type_de_carte}}</td>
                <td>
                    <form method="GET" action="{{route('editAbonne', $abonne->id_abonne)}}">
                        <button type="Submit">Modifier</button>
                    </form>
                    
                    <form methode="GET" action="{{route('showAbonne', $abonne->id_abonne)}}">
                        <button type="Submit">Afficher</button>
                    </form>

                    <form method="POST" action="{{route('destroyAbonne', $abonne->id_abonne)}}">
                        @csrf
                        @method("DELETE")
                        <button type="Submit">Supprimer</button>
                    </form>
                </td>
            </tr>
    @empty
        <span>Aucun Abonne</span>
    @endforelse
    </table>

</div>

