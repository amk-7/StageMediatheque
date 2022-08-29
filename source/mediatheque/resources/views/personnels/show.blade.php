@extends("layout.base")

@section("content")

    <style>
        td, th {border: 2px solid black;}

        caption {background-color: deepskyblue;}

        label {background-color: red;}

        th {background-color: chartreuse;}

        td {background-color: burlywood;}
    </style>

    <h1>Liste des abonnes</h1>
    <div>
        <table>
            <caption>Information sur les abonnes</caption>
            <tr>
                <th>Identifiant du Personnel</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>{{$personnel->id_personnel}}</td>
                <td>{{$personnel->statut}}</td>
                <td>
                    <form action="{{route('editPersonnel', $personnel->id_personnel)}}" method="get">
                        @csrf
                        <button type="submit">Modifier</button>
                    </form>
                    <form action="{{route('destroyPersonnel', $personnel->id_personnel)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        </table>
        <form action="{{route('listePersonnels')}}" method="get">
            @csrf
            <button type="submit">Retour</button>
        </form>
    </div>  
@endsection