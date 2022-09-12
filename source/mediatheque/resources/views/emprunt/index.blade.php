@extends('layout.base')

@section('content')
    <h1> Liste des Emprunts </h1>
    <form method="GET" action="{{route('createEmprunt')}}">
        <button type="Submit">Ajouter un Emprunt</button>
    </form>
    <div>
        @if(!empty($emprunts ?? "") && $emprunts->count() > 0)
            <table border="1">
                <caption>Liste des Emprunts</caption>
                <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Date de l'emprunt</th>
                    <th>Nombre Ouvrage</th>
                    <th>Date de retour</th>
                    <th>Abonné</th>
                    <th>personnel</th>
                    <th>Consulter</th>
                    <th>Editer</th>
                    <th>Restituer</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                @foreach($emprunts as $emprunt)
                    <tr>
                        <td> {{ $emprunt->id_emprunt }} </td>
                        <td> {{ $emprunt->date_emprunt->format('Y-m-d') }} </td>
                        <td> {{ $emprunt->nombreOuvrageEmprunte }} </td>
                        <td> {{ $emprunt->date_retour->format('Y-m-d') }} </td>
                        <td> {{ $emprunt->abonne->utilisateur->userFullName ?? "" }} </td>
                        <td> {{ $emprunt->personnel->utilisateur->userFullName ?? "" }} </td>
                        <td>
                            <form action="{{ route('showEmprunt', $emprunt)}}" method="get">
                                <input type="submit" value="Consulter">
                            </form>
                        </td>
                        <td>
                            <form action="{{route('editEmprunt', $emprunt)}}" method="get">
                                <input type="submit" value="Editer">
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('formulaireEnregistrementRestitution', $emprunt) }}" method="get">
                                @csrf
                                <input type="submit" value="Restituer">
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('destroyEmprunt', $emprunt) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="submit" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h4>Aucun emprunt</h4>
        @endif
    </div>
@endsection
