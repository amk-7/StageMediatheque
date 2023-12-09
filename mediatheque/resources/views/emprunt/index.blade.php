@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title"> Liste des Emprunts </h1>
        @include('components.abonne_search_bar')
        <div class="space-y-2 mt-8">
                <div class="flex space-x-3">
                    <form method="GET" action="{{ route('downloadExcelListeEnprunt') }}">
                        {{-- {{ \App\Service\EmpruntService::setEmpruntLIstInSession(collect($emprunts)['data']) }} --}}
                        <button type="Submit" class="button button_primary">Export</button>
                    </form>
                    <form method="GET" action="{{route('createEmprunt')}}">
                        <button type="Submit" class="button button_primary">Ajouter</button>
                    </form>
                </div>
            @if(!empty($emprunts ?? "") && $emprunts->count() > 0)
            <table class="fieldset_border bg-white">
                    <thead class="thead">
                    <tr class="fieldset_border">
                        <th class="fieldset_border">Numéro</th>
                        <th class="fieldset_border">Date de l'emprunt</th>
                        <th class="fieldset_border">Date de retour</th>
                        <th class="fieldset_border">Jour restant</th>
                        <th class="fieldset_border">Nombre Ouvrage</th>
                        <th class="fieldset_border">Abonné</th>
                        <th class="fieldset_border">personnel</th>
                        <th class="fieldset_border">Consulter</th>
                        <th class="fieldset_border">Editer</th>
                        <th class="fieldset_border">Restituer</th>
                        <th class="fieldset_border">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emprunts as $emprunt)

                        <tr class="fieldset_border">
                            <td class="fieldset_border"> {{ $emprunt->id_emprunt }} </td>
                            <td class="fieldset_border"> {{ $emprunt->date_emprunt }} </td>
                            {{-- {!! \App\Helpers\Controller::afficherDateRetoure($emprunt) !!}
                            {!! \App\Helpers\RestitutionHelper::afficherEnpruntJourRestant($emprunt) !!} --}}
                            <td class="fieldset_border"> {{ $emprunt->nombreOuvrageEmprunte }} </td>
                            <td class="fieldset_border"> {{ $emprunt->abonne->utilisateur->userFullName ?? "" }} </td>
                            <td class="fieldset_border"> {{ $emprunt->personnel->utilisateur->userFullName ?? "" }} </td>
                            <td class="fieldset_border">
                                <form action="{{ route('showEmprunt', $emprunt)}}" method="get">
                                    <input type="submit" class="button button_show" value="Consulter">
                                </form>
                            </td>
                            <td class="fieldset_border">
                                <form action="{{route('editEmprunt', $emprunt)}}" method="get">
                                    <input type="submit" class="button button_primary" value="Editer">
                                </form>
                            </td>
                            <td class="fieldset_border">
                                <!-- Verifier si l'emprunt à été déjà restituer -->
                                <form action="{{ route('formulaireEnregistrementRestitution', $emprunt) }}"
                                      method="get">
                                    @csrf
                                    {{-- <input type="submit" value="Restituer" class=
                                            @if(\App\Service\EmpruntService::etatEmprunt($emprunt))
                                                "button button_primary_disabled disabled:opacity-25 cursor-default" disabled
                                    @else
                                        "button button_primary "
                                    @endif> --}}
                                </form>
                            </td><!--"class='button button_primary_disabled disabled:opacity-25' disabled"-->
                            <td class="fieldset_border">
                                <form action="" method="post">
                                    @csrf
                                    @method("DELETE")
                                    {{-- <input type="submit" onclick="activeModal({{$emprunt->id_emprunt}})" value="Supprimer" class=
                                            @if(\App\Service\EmpruntService::etatEmprunt($emprunt))
                                                "button button_delete_disabled disabled:opacity-25" disabled
                                    @else
                                        "button button_delete"
                                    @endif> --}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $emprunts->links() !!}
            @else
                <h4>Aucun emprunt</h4>
            @endif
        </div>
    </div>
    <!-- Overlay element -->
    <div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
    <div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
        <div class="flex flex-col items-center space-y-4">
            <div id="id_message" class="text-center">
                <p>Voulez vous vraiment supprimer cet emprunt ?</p>
            </div>
            <div class="flex flex-row space-x-8">
                <button id="btn_annuler" class="button button_show">Annuler</button>
                <form id="form_delete_confirm" action="{{url("suppression_des_emprunts")}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" id="supprimer_ouvrage_confirm" name="supprimer" value="Supprimer" class="button button_delete">
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        let abonnes = {!! $abonnes !!};

        let nom_abonnes = document.getElementById('nom_abonnes');
        let prenom_abonnes = document.getElementById('prenom_abonnes');

        setLiteOptions(nom_abonnes, abonnes);
        nom_abonnes.addEventListener('change', function (e) {
            mettreListePrenomParNom(prenom_abonnes, nom_abonnes.value, abonnes);
        });

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

        //-------------------------------------------------
        let div_modal_supprimer = document.getElementById("modal_supprimer");
        let form_confirm = document.getElementById("form_delete_confirm");
        let btn_supprimer_ouvrage_confirm = document.getElementById("supprimer_ouvrage_confirm");
        let btn_annuler = document.getElementById("btn_annuler");
        let overlay = document.getElementById("overlay_suppression");

        function stopPropagation(){
            event.preventDefault();
            event.stopPropagation();
        }

        function activeModal(id){
            stopPropagation();
            div_modal_supprimer.classList.remove("hidden");
            overlay.classList.remove('hidden');
            form_confirm.action = `/suppression_des_emprunts/${id}`;
        }

        btn_annuler.addEventListener('click', function (){
            stopPropagation();
            div_modal_supprimer.classList.add("hidden");
            overlay.classList.add('hidden');
        });
    </script>
@stop
