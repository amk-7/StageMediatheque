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
        </tbody>
    </table>
@stop

