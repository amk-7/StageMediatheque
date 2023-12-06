@extends('layout.template.base')
@section("styles")
    <style type="text/css">

        .card{
            width: 200px;
            height: 350px;
            margin: auto;
        }
        .image {
            width: 198px;
            height: 300px;
        }
        .image img {
            width: 100%;
            height: 100%;
        }
        .label {
            padding: 10px 2%;
            justify-content: center;
            text-align: center;
        }

        .online {
            position: relative;
        }
        .online::after {
            position: absolute;
            content: "3";
            background: red;
            width: 30px;
            height: 20px;
            border-radius: 4px ;
            color: white;
            right: 0px;
            text-align: center;
        }
    </style>
@endsection
@section("content")
    <div class="flex flex-col justify-center items-center m-auto my_content">
        <h1 class="text-3xl mb-3"> Livres papier </h1>
        <div>
            @include('livresPapier.shareSearchBarLivrePapier')
        </div>
        <div class="flex flex-row content-center space-x-3">
            @if(Auth::user() && (Auth::user()->hasRole('responsable') || Auth::user()->hasRole('bibliothecaire')))
                <td class="flex flex-row mb-3">
                    <form action="{{route('formulaireEnregistrementLivrePapier')}}" method="get">
                        @csrf
                        <input type="submit" class="button button_primary" name="ajouter" value="ajouter">
                    </form>
                    <form action="{{route('formulaireEnregistrementApprovisionnements')}}" method="get">
                        @csrf
                        <input type="submit" class="button button_primary" name="approvisionement" value="approvisionner">
                    </form>
                    <form action="{{route('downloadExcelListeLivresPapier')}}" method="get">
                        @csrf
                        <input type="submit" class="button button_primary" name="export" value="Exporter">
                    </form>
                    <form action="{{route('imprimerOuvragesPhysiqueCodes')}}" method="get">
                        @csrf
                        <input type="submit" class="button button_show" name="export" value="Cotes QR codes">
                    </form>
                </td>
            @endif
        </div>

        @if(!empty($livresPapiers ?? "") && $livresPapiers->count())
            @if(Auth::user() && Auth::user()->hasRole('bibliothecaire'))
                @php
                    $result = \App\Service\OuvrageService::getNombreExamplaireAndOuvrage();
                    $nb_ouvrage = $result[0];
                    $nbr_examplaire = $result[1];
                @endphp
                <div class="flex">
                    <h3>Nombre d'ouvrages : {{ $nb_ouvrage }}</h3>
                    <h3 class="ml-3">Nombre d'examplaire : {{ $nbr_examplaire }}</h3>
                </div>
                <div class="m-3">
                    <table class="fieldset_border bg-white">
                        <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                            <tr>
                                <th class="fieldset_border">Numéro</th>
                                <th class="fieldset_border">Titre</th>
                                <th class="fieldset_border">Année apparution</th>
                                <th class="fieldset_border">Niveau</th>
                                <th class="fieldset_border">Type</th>
                                <th class="fieldset_border">Langue</th>
                                <th class="fieldset_border">Nombre d'exemplaire</th>
                                <th class="fieldset_border">Disponibilité</th>
                                <th class="fieldset_border">cote QR code</th>
                                <th class="fieldset_border">Consulter</th>
                                <th class="fieldset_border">Editer</th>
                                @if(Auth::user()->hasRole('responsable'))
                                    <th class="fieldset_border">Supprimer</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="all_data">
                        @foreach($livresPapiers as $livresPapier)
                            <tr class="dark:text-gray-500 text-center">
                                <td class="fieldset_border" >{{ $livresPapier->id_livre_papier }}</td>
                                <td class="fieldset_border uppercase"> {{ $livresPapier->ouvragesPhysique->ouvrage->titre }} </td>
                                <td class="fieldset_border"> {{ $livresPapier->ouvragesPhysique->ouvrage->annee_apparution }} </td>
                                <td class="fieldset_border"> {{ \App\Helpers\OuvrageHelper::afficherNiveau($livresPapier->ouvragesPhysique->ouvrage->niveau) }} </td>
                                <td class="fieldset_border"> {{ $livresPapier->ouvragesPhysique->ouvrage->type }} </td>
                                <td class="fieldset_border"> {{ $livresPapier->ouvragesPhysique->ouvrage->langue }} </td>
                                <td class="fieldset_border"> {{ $livresPapier->ouvragesPhysique->nombre_exemplaire }} </td>
                                <td class="fieldset_border"> {!! \App\Helpers\OuvragesPhysiqueHelper::afficherDisponibilite($livresPapier->ouvragesPhysique) !!} </td>
                                <td class="fieldset_border">
                                    <form>
                                        @csrf
                                    <div class="space-y-3">
                                        <div>
                                            {{ QrCode::generate($livresPapier->ouvragesPhysique->cote) }}
                                        </div>
                                        <div>
                                            <a href="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->generate($livresPapier->ouvragesPhysique->cote)) }}"
                                                download="{{ 'cote'.str_replace(' ', '_', strtolower($livresPapier->ouvragesPhysique->ouvrage->titre)).'qrcode.png' }}"
                                                class="text-center text-white bg-green-600 p-1 hover:bg-green-700 mt-2"
                                            >Imprimer
                                            </a>
                                        </div>
                                    </div>
                                    </form>
                                </td>
                                <td class="fieldset_border">
                                    <form action="{{route('affichageLivrePapier', $livresPapier)}}" method="get">
                                        @csrf
                                        <input type="submit" name="consulter" value="Consulter" class="button button_show">
                                    </form>
                                </td>
                                <td class="fieldset_border">
                                    <form action="{{route('formulaireModificationLivrePapier', $livresPapier)}}" method="get">
                                        @csrf
                                        <input type="submit" name="editer" value="Éditer" class="button button_primary">
                                    </form>
                                </td>
                                @if(Auth::user()->hasRole('responsable'))
                                    <td class="fieldset_border">
                                        <form id="" onclick="activeModal({{$livresPapier->id_livre_papier}})" action="{{route('suppressionLivrePapier', $livresPapier)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" id="" name="supprimer" value="Supprimer" class="button button_delete">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                        <tbody id="result" class="result_data"></tbody>
                    </table>
                </div>
            @else
                <!-- style="flex-wrap: wrap; margin-left: 95px;" -->
            <div class="flex flex-col items-center mb-12 w-full">
                @foreach($livresPapiers as $livresPapier)
                    <a href="{{route('affichageLivrePapier', $livresPapier)}}"  class="mb-3 flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full hover:bg-gray-100">
                        <img
                            class="object-cover rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                            src="{{ asset(''.$livresPapier->ouvragesPhysique->ouvrage->image) }}" alt=""
                            >
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <div class="space-y-3">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $livresPapier->ouvragesPhysique->ouvrage->titre }}
                                </h5>
                            </div>
                            {{-- @if(Auth::user() && Auth::user()->hasRole('abonne'))
                                <div class="flex flex-row space-x-10">
                                    <form method="post" action="{{route('enregistrerReservation')}}">
                                        @csrf
                                        <input type="text" name="data" value="{{ $livresPapier->ouvragesPhysique->id_ouvrage }}" hidden="true">
                                        <input type="submit" class="button button_primary" name="reservation" value="reserver">
                                    </form>
                                    <label class="button button_delete">{{ $livresPapier->ouvragesPhysique->nombre_exemplaire }}</label>
                                </div>
                            @endif --}}
                        </div>
                    </a>
                @endforeach
            </div>
            @endif
            <div style="margin-bottom: 100px">
                {!! $livresPapiers->links() !!}
            </div>
        @else
            <h3>Il n'y a aucun ouvrage.</h3>
        @endif

    </div>

    <div style="z-index:1000" id="overlay" class="fixed z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
    <div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_editer">
        <div class="flex flex-col items-center space-y-4">
            <div id="id_message" class="">
                <p id="etat_ouvrage_modif_erreur"></p>
            </div>
            <button id="btn_modifier" class="button button_primary">J'ai compris</button>
        </div>
    </div>
    <!-- Overlay element -->
    <div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
    <div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
        <div class="flex flex-col items-center space-y-4">
            <div id="id_message" class="text-center">
                <p>Voulez vous vraiment supprimer cet ouvrage ?</p>
            </div>
            <div class="flex flex-row space-x-8">
                <button id="btn_annuler" class="button button_show">Annuler</button>
                <form id="form_delete_confirm" action="{{url("suppression_livre_papier")}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" id="supprimer_ouvrage_confirm" name="supprimer" value="Supprimer" class="button button_delete">
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type='text/javascript' async>
        let message = "{!! \session('my_message') ?? "" !!}";
        let validatonMessage = "{!! \session('my_valiation_message') ?? "" !!}";
        let btn_confirm = document.getElementById("btn_modifier");
        let div_modal = document.getElementById("modal_editer");
        let div_message = document.getElementById("id_message");
        let p_etat_ouvrage_modif_erreur = document.getElementById("etat_ouvrage_modif_erreur");

        btn_confirm.addEventListener("click", function (){
            closeShowError();
        });

        //http://127.0.0.1:8000/formulaire_modification_livres_papier//modifier

        function closeShowError(){
            div_modal.classList.add('hidden');
            overlay.classList.add('hidden');
            {{ \session(['my_valiation_message' => ""])}}
            {{ \session(['my_message' => ""]) }}
        }

        function showError(){
            div_modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        }

        if (message === "" && validatonMessage === ""){
            closeShowError();
        } else if (message !== "") {
            p_etat_ouvrage_modif_erreur.innerText = message;
            div_message.classList = "alert";
            showError();
        } else {
            p_etat_ouvrage_modif_erreur.innerText = validatonMessage;
            div_message.classList = "info";
            showError();
        }

        //-------------------------------------------------
        let div_modal_supprimer = document.getElementById("modal_supprimer");
        let form_confirm = document.getElementById("form_delete_confirm");
        let btn_supprimer_ouvrage_confirm = document.getElementById("supprimer_ouvrage_confirm");
        let btn_annuler = document.getElementById("btn_annuler");

        function stopPropagation(){
            event.preventDefault();
            event.stopPropagation();
        }

        function activeModal(id){
            div_modal_supprimer.classList.remove("hidden");
            overlay.classList.remove('hidden');
            stopPropagation();
            form_confirm.action = `${form_confirm.action}/${id}`;
        }

        btn_annuler.addEventListener('click', function (){
            stopPropagation();
            div_modal_supprimer.classList.add("hidden");
            overlay.classList.add('hidden');
        });
    </script>
@endsection

