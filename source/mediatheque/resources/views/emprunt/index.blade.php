@extends('layout.template.base')

@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title"> Liste des Emprunts </h1>
        @include('reservation.share_search_bar')
        <div class="space-y-2 mt-8">
            @if(!empty($emprunts ?? "") && $emprunts->count() > 0)
                <div class="flex space-x-3">
                    <form method="GET" action="{{route('createEmprunt')}}">
                        <button type="Submit" class="button button_primary">Ajouter</button>
                    </form>
                    <form method="GET" action="{{ route('downloadExcelListeEnprunt') }}">
                        {{ \App\Service\EmpruntService::setEmpruntLIstInSession(collect($emprunts)['data']) }}
                        <button type="Submit" class="button button_primary">Export</button>
                    </form>
                </div>
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
                            <td class="fieldset_border"> {{ \App\Service\GlobaleService::afficherDate($emprunt->date_emprunt) }} </td>
                            {!! \App\Helpers\RestitutionHelper::afficherDateRetoure($emprunt) !!}
                            {!! \App\Helpers\RestitutionHelper::afficherEnpruntJourRestant($emprunt) !!}
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
                                    <input type="submit" value="Restituer" class=
                                            @if(\App\Service\EmpruntService::etatEmprunt($emprunt))
                                                "button button_primary_disabled disabled:opacity-25 cursor-default" disabled
                                    @else
                                        "button button_primary "
                                    @endif>
                                </form>
                            </td><!--"class='button button_primary_disabled disabled:opacity-25' disabled"-->
                            <td class="fieldset_border">
                                <form action="{{ route('destroyEmprunt', $emprunt) }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" value="Supprimer" class=
                                            @if(\App\Service\EmpruntService::etatEmprunt($emprunt))
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
                {!! $emprunts->links() !!}
            @else
                <h4>Aucun emprunt</h4>
            @endif
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
    </script>
@stop

