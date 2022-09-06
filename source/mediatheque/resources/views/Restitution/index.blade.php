@extends('layout.base')
@section('content')
    <h1>Liste des restitutions</h1>
    <div>
        <form>
            <input type="submit" value="Ajouter">
        </form>
    </div>
    <div>
        @if(! empty( $restitutions ?? "") && $restitutions->count() > 0)
            <table border="1">
                <thead>
                <tr>
                    <th>Numero</th>
                    <th>Nombre ouvrage</th>
                    <th>Abonne</th>
                    <th>Personnel</th>
                    <th>Etat ouvrage global</th>
                    <th>Date</th>
                    <th>Consulter</th>
                </tr>
                </thead>
                <tbody>
                @foreach($restitutions as $restitution)
                    <tr>
                        <td> {{ $restitution->id_restitution }} </td>
                        <td> {{ $restitution->nombreOuvrages }} </td>
                        <td> {{ $restitution->abonneFullName }} </td>
                        <td> {{ $restitution->personnelFullName }} </td>
                        <td> etat emprunt == etat restitution ? </td>
                        <td> {{ $restitution->date_restitution }} </td>
                        <td>
                            <form action="{{ route('affichageRestitution', $restitution) }}" method="get">
                                <input type="submit" value="Consulter">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
        @else
            <h2>Aucun approvisionnement</h2>
        @endif
@stop
