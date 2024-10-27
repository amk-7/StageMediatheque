@extends('layouts.app')
@section('content')
    <div class="flex flex-col justify-center items-center w-full ml-28 mx-12 space-y-6">
        <h1 class="text-3xl"> Liste des Abonnes </h1>
        <div class="space-y-3 w-full">
            <form class="flex flex-col items-center" method="get" action="">
                <div class="space-y-6">
                    <div class="w-96 lg:w-[800px]">
                        <div class="flex flex-row w-full border border-green-500">
                            <input class="w-10/12 lg:w-11/12 border border-none py-3" type="text" name="search_by" id="search_by" placeholder="rechercher par nom, prénom" value="{{ old('search_by') }}">
                            <button type="submit" class="flex flex-col items-center justify-center w-2/12 lg:w-1/12">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="space-y-3" id="searchParametersField">
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
                </div>
            </form>
            <div class="flex flex-row-reverse">
                <a href="{{ route('abonnes.create') }}">
                    <button type="button" class="button button_primary">Ajouter</button>
                </a>
            </div>
            <div class="w-full">
                <table class="bg-white w-full">
                    <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-300 dark:text-gray-500 text-left">
                        <tr class="fieldset_border w-full">
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
                            <th class="fieldset_border" >Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                    @forelse ($abonnes as $abonne)
                        @php
                            $is_registrate = $abonne->isRegistrate();
                        @endphp
                        @if($paye == null || $is_registrate == ($paye == "oui"))
                            <tr class="fieldset_border">
                                <td class="fieldset_border" ><img src="{{asset('storage/images/image_utilisateur').'/'.$abonne->utilisateur->photo_profil}}" width="80" height="80"></td>
                                <td class="fieldset_border" >{{$abonne->utilisateur->nom}}</td>
                                <td class="fieldset_border" >{{$abonne->utilisateur->prenom}}</td>
                                <td class="fieldset_border" >{{$abonne->utilisateur->email}}</td>
                                <td class="fieldset_border" >{{$abonne->utilisateur->contact}}</td>
                                <td class="fieldset_border" >{{$abonne->utilisateur->adresse["ville"]}}</td>
                                <td class="fieldset_border" >{{$abonne->profession}}</td>
                                <td class="fieldset_border" >{{$abonne->contact_a_prevenir}} </td>
                                <td class="fieldset_border" >{{$abonne->numero_carte}}</td>
                                <td class="fieldset_border" >{{ $abonne->type_de_carte == 0 ? "Scolaire" : "Identité"  }}</td>
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
                                <td class="fieldset_border">
                                    <div class="flex space-x-3 px-3">
                                        <div>
                                            <form method="GET" action="{{route('abonnes.edit', $abonne)}}">
                                                <button class="button button_primary" type="Submit">Editer</button>
                                            </form>
                                        </div>
                                        <div>
                                            <form methode="GET" action="{{route('abonnes.show', $abonne)}}">
                                                <button class="button button_show" type="Submit">Consulter</button>
                                            </form>
                                        </div>
                                        <div>
                                            @if(Auth::user()->hasRole('responsable'))
                                                @if(! $abonne->etat)
                                                <form method="POST" action="{{route('fenix_user', $abonne)}}">
                                                    @csrf
                                                    @method("PUT")
                                                    <button class="button button_primary" type="Submit">Activer</button>
                                                </form>
                                                @else
                                                    <form method="POST" action="" id="form_destroy_{{$abonne}}">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button class="button button_delete" type="button" onclick="AlertSwal(title='Attention', text='Voulez vous vraiment désactiver cet abonné ?', icon='warning', form_tag='form_destroy_{{$abonne->id_abonne}}');">Désactiver</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td class="fieldset_border">
                                Aucun abonné n'est enregistré
                            </td>
                            <td class="fieldset_border">
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-full">
            {{ $abonnes->links() }}
        </div>
    </div>
@endsection
@if (session('success'))
@section('js')
    <script>
        AlertSwalInfo(title='Info', text="{!! session('success') !!}", icon='success');
    </script>
@endsection
@endif
@if (session('error'))
@section('js')
    <script>
        AlertSwalInfo(title='Info', text="{!! session('error') !!}", icon='error');
    </script>
@endsection
@endif

