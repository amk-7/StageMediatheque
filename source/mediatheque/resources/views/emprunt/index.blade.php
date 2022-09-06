<?php ?>

<style>
    td, th {border: 2px solid black;}

    caption {background-color: deepskyblue;}

    label {background-color: red;}

    th {background-color: chartreuse;}

    td {background-color: burlywood;}
</style>
<h1> Liste des Emprunts </h1>
<form method="GET" action="{{route('createEmprunt')}}">
    <button type="Submit">Ajouter un Emprunt</button>
</form>
<div>
    <table>
        <caption>Informations sur les Emprunts</caption>
        <tr>
            <th>Identifiant de l'emprunt</th>
            <th>Identifiant de l'abonné</th>
            <th>Identifiant de l'ouvrage</th>
            <th>Etat de l'emprunt</th>
            <th>Modifier</th>
            <th>Afficher</th>
            <th>Supprimer</th>
        </tr>
        @forelse ($listeEmprunts as $emprunt)
            <tr>
                <td>{{$emprunt->id_emprunt}}</td>
                <td>{{$emprunt->id_abonne}}</td>
                <td>{{$emprunt->id_ouvrage_physique}}</td>
                <td>{{$emprunt->etat}}</td>
                <td>
                    <form method="GET" action="{{route('editEmprunt', $emprunt)}}">
                        <button type="Submit">Modifier</button>
                    </form>
                </td>
                <td>
                    <form method="GET" action="{{route('showEmprunt', $emprunt)}}">
                        <button type="Submit">Afficher</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{route('deleteEmprunt', $emprunt)}}">
                        @csrf
                        @method('DELETE')
                        <button type="Submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Aucun emprunt</td>
            </tr>
        @endforelse
    </table>
</div>
