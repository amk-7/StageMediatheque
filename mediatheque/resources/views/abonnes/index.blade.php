@extends('layouts.app')
@section('content')
    <div class="flex flex-col justify-center items-center m-auto" style="margin-top: 100px;">
        <h1 class="label_title">Liste des Abonnes {{  old('paye') }} </h1>
        <form class="flex flex-col items-center" method="get" action="{{route("listeAbonnes")}}">
            <div class="">
                <div class="flex flex-row w-96">
                    <input class="search w-5/6" type="search" name="search_by" id="search_by" placeholder="rechercher par nom, prénom" value="{{ old('selected_search_by') }}">
                    <button type="submit" class="button button_primary w-1/6">
                        <img src="{{ asset('storage/images/search.png') }}" class="block h-auto w-auto fill-current text-gray-600">
                    </button>
                </div>
            </div>
            <div class="" id="searchParametersField">
                <p>Paramètres de recherche</p>
                <div class="flex space-x-3">
                    <select name="paye" class="select_btn">
                        <option value="">Ont Payé</option>
                        <option value="oui" {{ $paye=="oui" ? "selected" : "" }}>oui</option>
                        <option value="non" {{ $paye=="non" ? "selected" : "" }}>non</option>
                    </select>
                    <select name="profession" class="select_btn">
                        <option value="">Profession</option>
                        <option value="Eleve" {{ $selected_profession=="Eleve" ? "selected" : "" }} >Élève</option>
                        <option value="Etudiant" {{ $selected_profession=="Etudiant" ? "selected" : "" }} >Étudiant</option>
                        <option value="Fonctionnaire" {{ $selected_profession=="Fonctionnaire" ? "selected" : "" }} >Fonctionnaire</option>
                        <option value="Retraite" {{ $selected_profession=="Retraite" ? "selected" : "" }} >Retraité</option>
                    </select>
                    <select name="niveau_etude" class="select_btn">
                        <option value="">Niveau étude</option>
                        <option value="primaire" {{ $selected_niveau_etude=="primaire" ? "selected" : "" }} >Primaire</option>
                        <option value="college" {{ $selected_niveau_etude=="college" ? "selected" : "" }} >Collège</option>
                        <option value="lycee" {{ $selected_niveau_etude=="lycee" ? "selected" : "" }} >Lycée</option>
                        <option value="Université" {{ $selected_niveau_etude=="Université" ? "selected" : "" }} >Université</option>
                    </select>
                    <select name="etat" class="select_btn">
                        <option value="1" {{ $selected_etat=="1" ? "selected" : "" }}>Activer</option>
                        <option value="0" {{ $selected_etat=="0" ? "selected" : "" }}>Desactiver</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="ml-16" style="margin-bottom: 100px;">
            <div class="flex flex-row space-x-3 mb-3">
                <form method="GET" action="{{route('createAbonne')}}">
                    <button class="button button_primary" type="Submit">Ajouter</button>
                </form>
                <form method="GET" action="{{ route('downloadExcelListeAbonnes')}}">
                    {{-- {{ \App\Service\AbonneService::setAbonnesLIstInSession(collect($abonnes)['data']) }} --}}
                    <button class="button button_primary" type="Submit">Exporter</button>
                </form>
            </div>
            @if(!empty($abonnes ?? "") && $abonnes->count() > 0)
                <table class="fieldset_border bg-white" style="margin-bottom: 100px;">
                    <thead class="text-xs  uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                        <tr class="fieldset_border">
                            <th class="fieldset_border" >N°</th>
                            <th class="fieldset_border" >Profil</th>
                            <th class="fieldset_border" >Nom</th>
                            <th class="fieldset_border" >Prenom</th>
                            <th class="fieldset_border" >Email</th>
                            <th class="fieldset_border" >Contact</th>
                            <th class="fieldset_border" >Ville</th>
                            <th class="fieldset_border" >Profession</th>
                            <th class="fieldset_border" >Contact a prevenir</th>
                            <th class="fieldset_border" >Numero de Carte</th>
                            <th class="fieldset_border" >Type de Carte</th>
                            <th class="fieldset_border" >A payé</th>
                            <th class="fieldset_border" >Profil valider</th>
                            <th class="fieldset_border" >Modifier</th>
                            <th class="fieldset_border" >Afficher</th>
                            @if(Auth::user()->hasRole('responsable'))
                                <th class="fieldset_border" >Supprimer</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonnes as $abonne)
                            @php
                                $is_registrate = $abonne->isRegistrate();
                            @endphp
                            @if($paye == null || $is_registrate == ($paye == "oui"))
                                <tr class="fieldset_border">
                                    <td class="fieldset_border" >{{$loop->index+1}}</td>
                                    <td class="fieldset_border" ><img src="{{asset('storage/images/image_utilisateur').'/'.$abonne->utilisateur->photo_profil}}" width="80" height="80"></td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->nom}}</td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->prenom}}</td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->email}}</td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->contact}}</td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->adresse["ville"]}}</td>
                                    <td class="fieldset_border" >{{$abonne->profession}}</td>
                                    <td class="fieldset_border" >{{$abonne->contact_a_prevenir}} </td>
                                    <td class="fieldset_border" >{{$abonne->numero_carte}}</td>
                                    <td class="fieldset_border" >{{  $abonne->type_de_carte == 0 ? "Scolaire" : "Identité"  }}</td>
                                    <td class="fieldset_border" >
                                        @if ($is_registrate)
                                            <span class="info">Oui</span>
                                        @else
                                            <span class="alert">Non</span>
                                        @endif
                                    </td>
                                    <td class="fieldset_border" >
                                        @if ($abonne->profil_valider==1)
                                            <span class="info">Oui</span>
                                        @else
                                            <span class="alert">Non</span>
                                        @endif
                                    </td>
                                    <td class="fieldset_border" >
                                        <form method="GET" action="{{route('editAbonne', $abonne->id_abonne)}}">
                                            <button class="button button_primary" type="Submit">Editer</button>
                                        </form>
                                    </td>
                                    <td class="fieldset_border">
                                        <form methode="GET" action="{{route('showAbonne', $abonne->id_abonne)}}">
                                            <button class="button button_show" type="Submit">Consulter</button>
                                        </form>
                                    </td>
                                    @if(Auth::user()->hasRole('responsable'))
                                        <td class="fieldset_border" >
                                            @if(! $abonne->etat)
                                            <form method="POST" action="{{route('fenix_user', $abonne->id_abonne)}}">
                                                @csrf
                                                @method("PUT")
                                                <button class="button button_primary" type="Submit">Activer</button>
                                            </form>
                                            @else
                                                <form method="POST" action="">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button onclick="activeModal({{$abonne->id_abonne}})" class="button button_delete" type="Submit">Désactiver</button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <span>Aucun Abonne</span>
            @endif
            {!! $abonnes->links() !!}
        </div>
    </div>
    <!-- Overlay element -->
    <div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
    <div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
        <div class="flex flex-col items-center space-y-4">
            <div id="id_message" class="text-center">
                <p>Voulez vous vraiment désactiver cet abonne ?</p>
            </div>
            <div class="flex flex-row space-x-8">
                <button id="btn_annuler" class="button button_show">Annuler</button>
                <form id="form_delete_confirm" action="{{url("suppression_des_abonnes")}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" id="supprimer_ouvrage_confirm" name="supprimer" value="Oui" class="button button_delete">
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
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
            form_confirm.action = `suppression_des_abonnes/${id}`;
        }

        btn_annuler.addEventListener('click', function (){
            stopPropagation();
            div_modal_supprimer.classList.add("hidden");
            overlay.classList.add('hidden');
        });
    </script>
@stop

