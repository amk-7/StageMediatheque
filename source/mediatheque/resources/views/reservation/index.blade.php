@extends('layout.template.base')
@section('etat')
    <select name="etat" id="id_etat" class="select_btn w-full">
        <option value="-1">Séléctionner état</option>
        <option value="1">Valide</option>
        <option value="0">Expiré</option>
    </select>
@stop
@section('content')
    <style>
        .container {
            height: 300px;
            width: 300px;
            overflow-x: scroll;
        }
        .data, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 4px;
        }
    </style>
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title"> Liste des Réservations</h1>
        @include('reservation.share_search_bar')
        <div class="space-y-2 mt-8 container">
            @if(!empty($reservations ?? "") && $reservations->count() > 0)
                <table class="fieldset_border bg-white data">
                    <thead class="thead">
                        <tr class="fieldset_border">
                            <th class="fieldset_border" >Numéro</th>
                            <th class="fieldset_border" >Date de réservation</th>
                            <th class="fieldset_border" >Durer réservation</th>
                            <th class="fieldset_border" >Durer restant</th>
                            <th class="fieldset_border" >Abonné</th>
                            <th class="fieldset_border" >ouvrage</th>
                            <th class="fieldset_border" >Etat</th>
                            @if(Auth::user()->hasRole('bibliothecaire'))
                                <th class="fieldset_border" >Etat sorti</th>
                                <th class="fieldset_border" >Emprunter</th>
                            @endif
                            <th class="fieldset_border" >Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)

                        <tr class="fieldset_border" >
                            <td class="fieldset_border" > {{ $loop->index +1 }} </td>
                            <td class="fieldset_border" > {{ \App\Service\GlobaleService::afficherDate($reservation->date_reservation) }} </td>
                            <td class="fieldset_border" > {{ $reservation->durre." H" }} </td>
                            <td class="fieldset_border" > {{ \App\Helpers\ReservationHelper::afficherDurreRestante(\App\Service\ReservationService::reservationExpirer($reservation)) }} </td>
                            <td class="fieldset_border" > {{ $reservation->abonne->utilisateur->userFullName }} </td>
                            <td class="fieldset_border" > {{ $reservation->ouvragePhysique->ouvrage->titre ?? "" }} </td>
                            {!! \App\Helpers\ReservationHelper::afficherEtat($reservation) !!}
                            @if(Auth::user()->hasRole('bibliothecaire'))
                                <form method="post" action="{{ route('enregistrerReservationEmprunt', $reservation) }}">
                                    @csrf
                                    <td class="fieldset_border" >
                                        <select name="etat" id="etat_entree_ouvrage_edite{{$loop->index+1}}" class=
                                            @if($reservation->etat==0)
                                                "disabled:opacity-25" disabled
                                        @endif>
                                            <option selected>Séléctionner etat</option>
                                            @for($i=4; $i>3; $i--)
                                                <option value="{{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }}"> {{ \App\Helpers\OuvragesPhysiqueHelper::demanderEtat()[$i] }} </option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td class="fieldset_border" >
                                            <input type="submit" id="emp{{ $loop->index +1 }}" onclick="emprunter({{ $loop->index +1 }})" value="Emprunter" class=
                                                @if($reservation->etat==0)
                                                        "button button_show disabled:opacity-25" disabled
                                            @else
                                                "button button_show"
                                            @endif>
                                    </td>
                                </form>
                            @endif
                            <td class="fieldset_border" >
                                <form action="{{ route('destroyReservation', $reservation) }}" method="post">
                                    @csrf
                                    @method('delete')
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
    <!-- Overlay element -->
    <div id="overlay" style="z-index: 1000;" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
    <div style="z-index: 1001;" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_editer">
        <div class="flex flex-col items-center space-y-4">
            <div class="alert">
                <p id="etat_ouvrage_modif_erreur">Vous devez renseigner l'état de l'ouvrage emprunté .</p>
            </div>
            <button id="btn_modifier" class="button button_primary">J'ai compris</button>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" async>
        let abonnes = {!! $abonnes !!};
        let btn_confirm = document.getElementById("btn_modifier");
        let div_modal = document.getElementById("modal_editer");

        let nom_abonnes = document.getElementById('nom_abonnes');
        let prenom_abonnes = document.getElementById('prenom_abonnes');

        setLiteOptions(nom_abonnes, abonnes);
        nom_abonnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_abonnes, nom_abonnes.value, abonnes);
        });

        btn_confirm.addEventListener("click", function (){
            closeShowError();
        });

        function closeShowError(){
            div_modal.classList.add('hidden');
            overlay.classList.add('hidden');
        }

        function showError(){
            div_modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        }

        function emprunter(i){
            console.log(`etat_entree_ouvrage_edite${i}`);
            let etat_entree_ouvrage_edite = document.getElementById(`etat_entree_ouvrage_edite${i}`);
            if (etat_entree_ouvrage_edite.value === "Séléctionner etat"){
                showError();
                stopPropagation();
            }
        }

        function stopPropagation() {
            event.stopPropagation();
            event.preventDefault();
        }

        function setLiteOptions(elt, liste) {
            for (let i = 0; i < liste.length; i++) {
                let option = document.createElement('option');
                option.value = liste[i]['nom'];
                option.innerText = option.value;
                elt.appendChild(option);
            }
        }

        function mettreListePrenomParNom(balise, elt, liste) {
            while (balise.firstChild) {
                balise.removeChild(balise.firstChild);
            }
            let option = document.createElement('option');
            option.innerText = "Séléctionner prénom";
            balise.appendChild(option);
            for (let i = 0; i < liste.length; i++) {
                if (elt === liste[i]['nom']) {
                    let option = document.createElement('option');
                    option.value = liste[i]['id'];
                    option.innerText = liste[i]['prenom'];
                    balise.appendChild(option);
                }
            }
        }

    </script>
@stop
