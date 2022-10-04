@extends('layout.template.base')
@section('content')
    <h1>Liste des approvisionnements</h1>
    <div>
        <form>
            <input type="submit" value="Ajouter">
        </form>
    </div>
    @if(! empty($approvisionnements ?? "") and $approvisionnements->count() >0)
        <table>
            <thead>
            <tr>
                <th>Numero</th>
                <th>Ouvrage</th>
                <th>Type identifiant</th>
                <th>Code identifiant</th>
                <th>Nombre exempalire</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date</th>
                <th>Consulter</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            @foreach($approvisionnements as $approvisionnement)
                <tr>
                    <td> {{ $approvisionnement->id_approvisionnement }} </td>
                    <td> {{ $approvisionnement->ouvragesPhysique->ouvrage->titre }} </td>
                    <td> {{ \App\Helpers\ApprovisionnementHelper::afficherTypeIdentifiant($approvisionnement) }} </td>
                    <td> {{ \App\Helpers\ApprovisionnementHelper::afficherIdentifiant($approvisionnement) }} </td>
                    <td> {{ $approvisionnement->nombre_exemplaire }} </td>
                    <td> {{ $approvisionnement->personnel->utilisateur->nom }} </td>
                    <td> {{ $approvisionnement->personnel->utilisateur->prenom }} </td>
                    <td> {{ $approvisionnement->date_approvisionnement }} </td>
                    <td>
                        <form>
                            <input type="submit" name="consulter" value="Consulter">
                        </form>
                    </td>
                    <td>
                        <form>
                            <input type="submit" name="supprimer" value="Supprimer">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h2>Aucun approvisionnement</h2>
    @endif
@stop
