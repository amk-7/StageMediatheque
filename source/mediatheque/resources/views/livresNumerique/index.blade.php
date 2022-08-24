@extends('layout.base')
@section('content')
    <h1> Livres Numerique </h1>
    <div>
        <td>
            <form action="{{route('formulaireEnregistrementLivreNumerique')}}" method="get">
                @csrf
                <input type="submit" name="ajouter" value="ajouter">
            </form>
        </td>
    </div>
    <table border="1">
        <thead>
            <th>Image</th>
            <th>Titre</th>
            <th>Auteurs</th>
            <th>Lieu d'édition</th>
            <th>Année d'édition</th>
            <th>Niveau</th>
            <th>Type</th>
            <th>Domaine</th>
            <th>ISBN</th>
            <th>Langue</th>
            <th>url</th>
            <th>Action</th>
        </thead>
        <tbody>
        @foreach($livresNumeriques as $livresNumerique)
            <tr>
                <td> <img src="" alt="image du livre"> </td>
                <td> {{ $livresNumerique->ouvrageElectronique->ouvrage->titre }} </td>
                <td> {{ \App\Helpers\OuvrageHelper::afficherAuteurs( $livresNumerique->ouvrageElectronique->ouvrage) }} </td>
                <td></td>
                <td></td>
                <td> {{ $livresNumerique->ouvrageElectronique->ouvrage->niveau }} </td>
                <td> {{ $livresNumerique->ouvrageElectronique->ouvrage->type }} </td>
                <td> {{ $livresNumerique->categorie }} </td>
                <td> {{ $livresNumerique->ISBN }} </td>
                <td> {{ $livresNumerique->ouvrageElectronique->ouvrage->langue }} </td>
                <td> {{ $livresNumerique->ouvrageElectronique->url }} </td>
                <td>
                    <form action="{{route('affichageLivreNumerique', $livresNumerique)}}" method="get">
                        @csrf
                        <input type="submit" name="consulter" value="Consulter">
                    </form>
                    <form action="{{route('formulaireModificationLivreNumerique', $livresNumerique)}}" method="get">
                        @csrf
                        <input type="submit" name="editer" value="Éditer">
                    </form>
                    <form action="{{route('suppressionLivreElectronique', $livresNumerique)}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" name="supprimer" value="Supprimer">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

