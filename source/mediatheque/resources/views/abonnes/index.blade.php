@extends('layout.template.base')
@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title">Liste des Abonnes</h1>
        <div class="ml-16">
            <div>
                <form method="GET" action="{{route('createAbonne')}}">
                    <button class="button button_primary" type="Submit">Ajouter</button>
                </form>
            </div>
            <table class="fieldset_border">
                <tr class="fieldset_border" >
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
                    <th class="fieldset_border" >Supprimer</th>
                </tr>
                @forelse ($listeAbonnes as $abonne)
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
                        <td class="fieldset_border" >
                            <form methode="GET" action="{{route('showAbonne', $abonne->id_abonne)}}">
                                <button class="button button_show" type="Submit">Consulter</button>
                            </form>
                        </td>
                        <td class="fieldset_border" >
                            <form method="POST" action="{{route('destroyAbonne', $abonne->id_abonne)}}">
                                @csrf
                                @method("DELETE")
                                <button class="button button_delete" type="Submit">Supprimer</button>
                            </form>
                        </td>
                        </td>
                    </tr>
                @empty
                    <span>Aucun Abonne</span>
                @endforelse
            </table>
        </div>
    </div>
@stop


