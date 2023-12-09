@extends('layouts.app')
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
                        <tr class="fieldset_border">
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
                                <form method="POST" action="">
                                    @csrf
                                    @method("DELETE")
                                    <button type="Submit" onclick="activeModal({{$personnel->id_personnel}})" class=@if(Auth::user()->id_utilisateur == $personnel->utilisateur->id_utilisateur)
                                        "button button_delete_disabled disabled:opacity-25" disabled
                                    @else
                                        "button button_delete"
                                        @endif> Supprimer</button>
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
    <!-- Overlay element -->
    <div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
    <div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
        <div class="flex flex-col items-center space-y-4">
            <div id="id_message" class="text-center">
                <p>Voulez vous vraiment supprimer cet emprunt ?</p>
            </div>
            <div class="flex flex-row space-x-8">
                <button id="btn_annuler" class="button button_show">Annuler</button>
                <form id="form_delete_confirm" action="" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" id="supprimer_ouvrage_confirm" name="supprimer" value="Supprimer" class="button button_delete">
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
            form_confirm.action = `suppression_des_personnels/${id}`;
        }

        btn_annuler.addEventListener('click', function (){
            stopPropagation();
            div_modal_supprimer.classList.add("hidden");
            overlay.classList.add('hidden');
        });

    </script>
@stop
