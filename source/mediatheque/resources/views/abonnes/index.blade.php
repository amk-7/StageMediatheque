@extends('layout.template.base')
@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title">Liste des Abonnes</h1>
        <form class="flex flex-col items-center" method="get" action="{{route("listeAbonnes")}}">
            <div class="">
                <div class="flex flex-row w-96">
                    <input class="search w-5/6" type="search" name="search_by" id="search_by" placeholder="rechercher par nom, prénom">
                    <button type="submit" class="button button_primary w-1/6">
                        <img src="{{ asset('storage/images/search.png') }}" class="block h-auto w-auto fill-current text-gray-600">
                    </button>
                </div>
            </div>
            <div class="" id="searchParametersField">
                <p>Paramètres de recherche</p>
                <div>
                    <select name="paye" class="select_btn">
                        <option value="">Ont Payé</option>
                        <option value="oui">oui</option>
                        <option value="non">non</option>
                    </select>
                    <select name="profession" class="select_btn">
                        <option value="">Profession</option>
                        <option value="Eleve">Élève</option>
                        <option value="Etudiant">Étudiant</option>
                        <option value="Fonctionnaire">Fonctionnaire</option>
                        <option value="Retraite">Retraité</option>
                    </select>
                    <select name="niveau_etude" class="select_btn">
                        <option value="">Niveau étude</option>
                        <option value="primaire">Primaire</option>
                        <option value="college">Collège</option>
                        <option value="lycee">Lycée</option>
                        <option value="Université">Université</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="ml-16">
            <div class="flex flex-row space-x-3 mb-3">
                <form method="GET" action="{{route('createAbonne')}}">
                    <button class="button button_primary" type="Submit">Ajouter</button>
                </form>
                <form method="GET" action="{{ route('downloadExcelListeAbonnes')}}">
                    {{ \App\Service\AbonneService::setAbonnesLIstInSession(collect($abonnes)['data']) }}
                    <button class="button button_primary" type="Submit">Exporter</button>
                </form>
            </div>
            @if(!empty($abonnes ?? "") && $abonnes->count() > 0)
                <table class="fieldset_border">
                    <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                        <tr class="fieldset_border">
                            <th class="fieldset_border" >N°</th>
                            <th class="fieldset_border" >Profil</th>
                            <th class="fieldset_border" >Nom</th>
                            <th class="fieldset_border" >Prenom</th>
                            <th class="fieldset_border" >Nom d'utilisateur</th>
                            <th class="fieldset_border" >Email</th>
                            <th class="fieldset_border" >Contact</th>
                            <th class="fieldset_border" >Ville</th>
                            <th class="fieldset_border" >Profession</th>
                            <th class="fieldset_border" >Contact a prevenir</th>
                            <th class="fieldset_border" >Numero de Carte</th>
                            <th class="fieldset_border" >Type de Carte</th>
                            <th class="fieldset_border" >A payé</th>
                            <th class="fieldset_border" >Mofier</th>
                            <th class="fieldset_border" >Afficher</th>
                            @if(Auth::user()->hasRole('responsable'))
                                <th class="fieldset_border" >Supprimer</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonnes as $abonne)
                            @php
                                $payeB = ($paye == "oui" ? true : false);
                            @endphp
                            @if($paye == null ? true : false || $abonne->isRegistrate()==$payeB)
                                <tr class="fieldset_border">
                                    <td class="fieldset_border" >{{$loop->index+1}}</td>
                                    <td class="fieldset_border" ><img src="{{asset('storage/images/image_utilisateur').'/'.$abonne->utilisateur->photo_profil}}" width="80" height="80"></td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->nom}}</td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->prenom}}</td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->nom_utilisateur}}</td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->email}}</td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->contact}}</td>
                                    <td class="fieldset_border" >{{$abonne->utilisateur->adresse["ville"]}}</td>
                                    <td class="fieldset_border" >{{$abonne->profession}}</td>
                                    <td class="fieldset_border" >{{$abonne->contact_a_prevenir}}</td>
                                    <td class="fieldset_border" >{{$abonne->numero_carte}}</td>
                                    <td class="fieldset_border" >{{$abonne->type_de_carte}}</td>
                                    <td class="fieldset_border" >{{$abonne->isRegistrate() ? 'Oui' : 'Non'}}</td>
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
                                            <form method="POST" action="{{route('destroyAbonne', $abonne->id_abonne)}}">
                                                @csrf
                                                @method("DELETE")
                                                <button class="button button_delete" type="Submit">Supprimer</button>
                                            </form>
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
@stop


