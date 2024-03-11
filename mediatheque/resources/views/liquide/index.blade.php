@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center m-auto">
        <h1 class="text-3xl"> Liste des Abonements </h1>
        <div>
            <form class="flex flex-col items-center" method="get" action="{{route("listeLiquides")}}">
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
                        <select id="min" name="min_annee" class="select_btn w-1/3 mb-3">
                            <option value=""> Début </option>
                            @for($a=$min_annee; $a <= $max_annee; $a++)
                                <option value="{{ $a }}" {{ $selected_min==$a ? "selected" : "" }} > {{ $a }} </option>
                            @endfor
                        </select>
                        <select id="max" name="max_annee" class="select_btn w-1/3 mb-3" style="">
                            <option value=""> Fin </option>
                            @for($a=$max_annee; $a >= $min_annee; $a--)
                                <option value="{{ $a }}" {{ $selected_max==$a ? "selected" : "" }} > {{ $a }} </option>
                            @endfor
                        </select>
                        <select name="etat" class="select_btn w-1/3 mb-3">
                            <option value="" {{ $selected_etat=="" ? "selected" : "" }}>Tous</option>
                            <option value="1" {{ $selected_etat=="1" ? "selected" : "" }}>Activer</option>
                            <option value="0" {{ $selected_etat=="0" ? "selected" : "" }}>Desactiver</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="flex justify-between">
                <div>
                    <form method="GET" action="{{route('createLiquide')}}" class="mb-3">
                        @csrf
                        <button type="Submit" class="button button_primary">Faire un abonement</button>
                    </form>
                    <form method="GET" action="{{ route('exporter_abonnements') }}" class="mb-3">
                        @csrf
                        <button type="Submit" class="button button_show">Imprimer</button>
                    </form>
                </div>
                <form method="POST" action="" class="mb-3">
                    @method('delete')
                    @csrf
                    <button type="Submit" class="button button_delete" onclick="activeModal('-')">Annuler abonement</button>
                </form>
            </div>
            @if(!empty($liquides ?? "") && $liquides->count() > 0)
                <table class="bg-white">
                    <thead class="text-xs bg-white uppercase bg-gray-50 dark:bg-gray-300 dark:text-gray-500 text-center">
                        <tr class="fieldset_border">
                            <th class="fieldset_border">Abonne</th>
                            <th class="fieldset_border">Tarif</th>
                            <th class="fieldset_border">Date debut</th>
                            <th class="fieldset_border">Date fin</th>
                            <th class="fieldset_border">Etat</th>
                            <th class="fieldset_border">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                    @foreach($liquides as $liquide)
                        <tr class="fieldset_border">
                            <td class="fieldset_border"> {{ $liquide->registration->abonne->utilisateur->userFullName }} </td>
                            <td class="fieldset_border"> {{ $liquide->registration->tarifAbonnement->designation }} </td>
                            <td class="fieldset_border"> {{ $liquide->registration->date_debut->format('Y-m-d') }} </td>
                            <td class="fieldset_border"> {{ $liquide->registration->date_fin->format('Y-m-d') }} </td>
                            <td class="fieldset_border">
                                @if ($liquide->registration->etat==0)
                                    <span class="alert">Expiré</span>
                                @else
                                    <span class="info">Actif</span>
                                @endif
                            </td>
                            <td class="fieldset_border">
                                <input type="button" onclick="activeModal('{{$liquide->id_liquide}}')" value="Annuler" class="button button_delete">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h4>Aucun abonnement</h4>
            @endif
        </div>
        {{ $liquides->links() }}
    </div>
    <!-- Overlay element -->
    <div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
    <div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
        <div class="flex flex-col items-center space-y-4">
            <div id="id_message" class="text-center">
                <p>Voulez vous  annuler tous les abonnement ?</p>
            </div>
            <div class="flex flex-row space-x-8">
                <button id="btn_annuler" class="button button_show">Annuler</button>
                <form id="form_delete_confirm" action="{{route('destroyLiquide')}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" id="supprimer_ouvrage_confirm" name="supprimer" value="Supprimer" class="button button_delete">
                </form>
            </div>
        </div>
    </div>
@endsection
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
            if (id==='-') {
                form_confirm.action = `${form_confirm.action}/`;
            } else {
                form_confirm.action = `/suppression_liquide/${id}/`;
            }
        }

        btn_annuler.addEventListener('click', function (){
            stopPropagation();
            div_modal_supprimer.classList.add("hidden");
            overlay.classList.add('hidden');
        });
    </script>
@stop
