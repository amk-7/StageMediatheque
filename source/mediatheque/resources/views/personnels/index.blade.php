<?php ?>
<style>
    td, th {border: 2px solid black;}

    caption {background-color: deepskyblue;}

    label {background-color: red;}

    th {background-color: chartreuse;}

    td {background-color: burlywood;}
</style>

<h1>Liste du Personnels</h1>
<div>
    <table>
        <caption>Informations sur les Personnels</caption>
        <tr>
            <th> Identifiant du Personnels </th>
            <th> Statut </th>
            <th> Action </th>
        </tr>
    @forelse ($listePersonnels as $personnel)
            <tr>
                <td>{{$personnel->id_personnel}}</td>
                <td>{{$personnel->statut}}</td>
                <td>
                    <form method="GET" action="{{route('editPersonnel', $personnel->id_personnel)}}">
                        <button type="Submit">Modifier</button>
                    </form>

                    <form methode="GET" action="{{route('showPersonnel', $personnel->id_personnel)}}">
                        <button type="Submit">Afficher</button>
                    </form>

                    <form method="POST" action="{{route('destroyPersonnel', $personnel->id_personnel)}}">
                        @csrf
                        @method("DELETE")
                        <button type="Submit">Supprimer</button>
                    </form>
                </td>
            </tr>
    @empty
            <tr><td><label>Il n y a pas de Personnels</label></td></tr>
    @endforelse
    </table>
    <form method="GET" action="{{route('createPersonnel')}}">
        <button type="Submit">Ajouter un Personnel</button>
    </form>
    {{--$listePersonnels->links()--}}
</div>