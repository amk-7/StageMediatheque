@extends('layout.template.base')
@section("livewire_styles_content")
    @livewireStyles
@stop
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
    @livewire('ouvrage.index-livre-papier-livewire', [
    'annees'=>$annees,
    'niveaus'=> $niveaus,
    'types'=>$types,
    'langues'=>$langues,
    'categories'=>$categories,
    'id_livre_papier'=>$id_livre_papier
    ])
    <!-- Overlay element -->
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
@section("livewire_scripts_content")
    @livewireScripts
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

