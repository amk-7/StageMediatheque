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
                <th>identifiant de l'abonné</th>
                <th>date naissance</th>
                <th>Niveau Etude</th>
                <th>Profession</th>
                <th>Contact à prevenir</th>
                <th>Numero de Carte</th>
                <th>Type de Carte</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>{{$abonne->id_abonne}}</td>
                <td>{{$abonne->date_naissance}}</td>
                <td>{{$abonne->niveau_etude}}</td>
                <td>{{$abonne->profession}}</td>
                <td>{{$abonne->contact_a_prevenir}}</td>
                <td>{{$abonne->numero_carte}}</td>
                <td>{{$abonne->type_de_carte}}</td>
                <td>
                    <form action="{{route('editAbonne', $abonne->id_abonne)}}" method="get">
                        @csrf
                        <button type="submit">Modifier</button>
                    </form>
                    <form action="{{route('destroyAbonne', $abonne->id_abonne)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        </table>
        <form action="{{route('listeAbonnes')}}" method="get">
            @csrf
            <button type="submit">Retour</button>
        </form>
    </div>
@endsection