@extends('layout.template.base')
@section('content')
    <div class="flex flex-col justify-center items-center">
        <h1 class="label_title">Liste du Personnels</h1>
        <div class="ml-16">
            <div class="mb-3">
                <form method="GET" action="{{route('createPersonnel')}}">
                    <button type="Submit" class="button button_primary">Ajouter un Personnel</button>
                </form>
            </div>
            <table class="fieldset_border bg-white">
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
                        <th class="fieldset_border" >Quartier</th>
                        <th class="fieldset_border" >Numero de maison</th>
                        <th class="fieldset_border" >Sexe</th>
                        <th class="fieldset_border" > Statut </th>
                        <th class="fieldset_border" > Modifier </th>
                        <th class="fieldset_border" > Afficher </th>
                        <th class="fieldset_border" > Supprimer </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($personnels as $personnel)
                        <tr class="fieldset_border" >
                            <td class="fieldset_border" >{{$loop->index+1}}</td>
                            <td class="fieldset_border" ><img src="{{asset('storage/images/image_utilisateur').'/'.$personnel->utilisateur->photo_profil}}" width="80" height="80"
                                                              style="width: 80px; height: 80px"></td>
                            <td class="fieldset_border" >{{$personnel->utilisateur->nom}}</td>
                            <td class="fieldset_border" >{{$personnel->utilisateur->prenom}}</td>
                            <td class="fieldset_border" >{{$personnel->utilisateur->nom_utilisateur}}</td>
                            <td class="fieldset_border" >{{$personnel->utilisateur->email}}</td>
                            <td class="fieldset_border" >{{$personnel->utilisateur->contact}}</td>
                            <td class="fieldset_border" >{{$personnel->utilisateur->adresse["ville"]}}</td>
                            <td class="fieldset_border" >{{$personnel->utilisateur->adresse["quartier"]}}</td>
                            <td class="fieldset_border" >{{$personnel->utilisateur->adresse["numero_maison"]}}</td>
                            <td class="fieldset_border" >{{$personnel->utilisateur->sexe}}</td>
                            <td class="fieldset_border" >{{$personnel->statut}}</td>
                            <td class="fieldset_border" >
                                <form method="GET" action="{{route('editPersonnel', $personnel)}}">
                                    <button type="Submit" class="button button_primary">Editer</button>
                                </form>
                            </td>
                            <td class="fieldset_border" >
                                <form methode="GET" action="{{route('showPersonnel', $personnel)}}">
                                    <button type="Submit" class="button button_show" >Consulter</button>
                                </form>
                            </td>
                            <td class="fieldset_border" >
                                <form method="POST" action="{{route('destroyPersonnel', $personnel)}}">
                                    @csrf
                                    @method("DELETE")
                                    <button type="Submit" class="button button_delete" >Supprimer</button>
                                </form>
                            </td>
                            </td>
                        </tr>
                    @empty
                        <span>Aucun personnel n'a été trouvé</span>
                    @endforelse
                </tbody>
            </table>
            {{ $personnels->links() }}
        </div>
    </div>
@stop
