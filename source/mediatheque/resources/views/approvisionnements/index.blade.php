@extends('layout.template.base')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="label_title">Liste des approvisionnements</h1>
        <div class="mt-3 mb-3 flex flex-col justify-start">
            <form method="GET" action="{{ route('formulaireEnregistrementApprovisionnements') }}">
                <input type="submit" value="Ajouter" class="button button_primary">
            </form>
        </div>
        @if(! empty($approvisionnements ?? "") and $approvisionnements->count() >0)
            <table>
                <thead>
                <tr>
                    <th class="fieldset_border">Numero</th>
                    <th class="fieldset_border">Ouvrage</th>
                    <th class="fieldset_border">Type identifiant</th>
                    <th class="fieldset_border">Nombre exempalire</th>
                    <th class="fieldset_border">Nom</th>
                    <th class="fieldset_border">Prenom</th>
                    <th class="fieldset_border">Date</th>
                    <th class="fieldset_border">Consulter</th>
                    <th class="fieldset_border">Supprimer</th>
                </tr>
                </thead>
                <tbody>
                @foreach($approvisionnements as $approvisionnement)
                    <tr>
                        <td class="fieldset_border"> {{ $approvisionnement->id_approvisionnement }} </td>
                        <td class="fieldset_border"> {{ $approvisionnement->ouvragesPhysique->ouvrage->titre }} </td>
                        <td class="fieldset_border"> {{ \App\Helpers\ApprovisionnementHelper::afficherTypeIdentifiant($approvisionnement) }} </td>
                        <td class="fieldset_border"> {{ $approvisionnement->nombre_exemplaire }} </td>
                        <td class="fieldset_border"> {{ $approvisionnement->personnel->utilisateur->nom }} </td>
                        <td class="fieldset_border"> {{ $approvisionnement->personnel->utilisateur->prenom }} </td>
                        <td class="fieldset_border"> {{ $approvisionnement->date_approvisioement }} </td>
                        <td class="fieldset_border">
                            <form>
                                <input type="submit" name="consulter" value="Consulter">
                            </form>
                        </td>
                        <td class="fieldset_border">
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
    </div>
@stop
