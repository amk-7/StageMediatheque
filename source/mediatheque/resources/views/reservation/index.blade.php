@extends('layout.template.base')

@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title"> Liste des Réservations </h1>
        <form method="get" action="" class="mt-8">
            <div class="flex flex-row space-x-3">
                <select name="nom_abonne" id="nom_abonnes" class="select_btn w-full">
                    <option>Séléctionner nom</option>
                </select>
                <select name="prenom_abonne" id="prenom_abonnes" class="select_btn w-full">
                    <option>Séléctionner prénom</option>
                </select>
                <input type="submit" value="rechercher" class="button button_primary">
            </div>
        </form>
        <div class="space-y-2 mt-8">
            @if(!empty($reservations ?? "") && $reservations->count() > 0)
                <table class="fieldset_border bg-white">
                    <thead class="thead">
                        <tr class="fieldset_border">
                            <th class="fieldset_border" >Numéro</th>
                            <th class="fieldset_border" >Date de réservation</th>
                            <th class="fieldset_border" >Durer réservation</th>
                            <th class="fieldset_border" >Durer restant</th>
                            <th class="fieldset_border" >Abonné</th>
                            <th class="fieldset_border" >ouvrage</th>
                            <th class="fieldset_border" >Etat</th>
                            <th class="fieldset_border" >Emprunter</th>
                            <th class="fieldset_border" >Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)

                        <tr class="fieldset_border" >
                            <td class="fieldset_border" > {{ $loop->index +1 }} </td>
                            <td class="fieldset_border" > {{ \App\Service\GlobaleService::afficherDate($reservation->date_reservation) }} </td>
                            <td class="fieldset_border" > {{ $reservation->durre }} H </td>
                            <td class="fieldset_border" > {{ \App\Service\ReservationService::reservationExpirer($reservation) }} H </td>
                            <td class="fieldset_border" > {{ $reservation->abonne->utilisateur->userFullName }} </td>
                            <td class="fieldset_border" > {{ $reservation->ouvragePhysique->ouvrage->titre ?? "" }} </td>
                            {!! \App\Helpers\ReservationHelper::afficherEtat($reservation) !!}
                            <td class="fieldset_border" >
                                <form method="post" action="{{ route('enregistrerReservationEmprunt', $reservation) }}">
                                    @csrf
                                    <input type="submit" value="Emprunter" class=
                                        @if($reservation->etat==0)
                                                "button button_show disabled:opacity-25" disabled
                                    @else
                                        "button button_show"
                                    @endif>
                                </form>
                            </td>
                            <td class="fieldset_border" >
                                <form action="" method="post">
                                    <input type="submit" value="Supprimer" class=
                                        @if($reservation->etat==0)
                                                    "button button_delete_disabled disabled:opacity-25" disabled
                                    @else
                                        "button button_delete"
                                    @endif>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $reservations->links() !!}
            @else
                <h4>Aucune Réservation</h4>
            @endif
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" async>
        let abonnes = {!! $abonnes !!};
    </script>
@stop
