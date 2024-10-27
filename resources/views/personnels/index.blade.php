
@extends('layouts.app')
@section('content')
    <div class="flex flex-col justify-center items-center w-full ml-28 mx-12 space-y-6">
        <h1 class="text-3xl"> Liste du personnel </h1>
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
                </div>
            </form>
            <div class="flex flex-row-reverse">
                <a href="{{ route('personnels.create') }}">
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
                            <th class="fieldset_border" >Nom d'utilisateur</th>
                            <th class="fieldset_border" >Email</th>
                            <th class="fieldset_border" >Contact</th>
                            <th class="fieldset_border" >Ville</th>
                            <th class="fieldset_border" >Quartier</th>
                            <th class="fieldset_border" >Numero de maison</th>
                            <th class="fieldset_border" >Sexe</th>
                            <th class="fieldset_border" > Statut </th>
                            <th class="fieldset_border" >Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                    @forelse ($personnels as $personnel)
                        <tr class="fieldset_border">
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

                            <td class="fieldset_border">
                                <div class="flex space-x-3 px-3">
                                    <div>
                                        <form method="GET" action="{{route('personnels.edit', $personnel->id_personnel)}}">
                                            <button class="button button_primary" type="Submit">Editer</button>
                                        </form>
                                    </div>
                                    <div>
                                        <form methode="GET" action="{{route('personnels.show', $personnel->id_personnel)}}">
                                            <button class="button button_show" type="Submit">Consulter</button>
                                        </form>
                                    </div>
                                    <div>
                                        @if(Auth::user()->hasRole('responsable'))
                                            <form method="POST" action="{{ route('personnels.destroy', $personnel->id_personnel) }}" id="form_destroy_{{$personnel->id_personnel}}">
                                                @csrf
                                                @method("DELETE")
                                                <button type="button" 
                                                    onclick="AlertSwal(title='Attention', text='Voulez vous vraiment supprimer cet personnel ?', icon='warning', form_tag='form_destroy_{{$personnel->id_personnel}}');"
                                                    class=@if(Auth::user()->id_utilisateur == $personnel->utilisateur->id_utilisateur)
                                                    "button button_delete_disabled disabled:opacity-25" disabled @else
                                                    "button button_delete" @endif> 
                                                    Supprimer
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="fieldset_border">
                                Aucun personnel n'est enregistré
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
            {{ $personnels->links() }}
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
