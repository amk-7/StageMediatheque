@extends('layouts.app')
@section("content")
<div class="flex flex-col justify-center items-center m-auto my_content">
    <h1 class="text-3xl mb-3">Liste des Ouvrages</h1>
    <div>
        @include('components.search')
    </div>
    <div class="flex flex-row content-center space-x-3">
        @if(Auth::user() && (Auth::user()->hasRole('responsable') || Auth::user()->hasRole('bibliothecaire')))
        <td class="flex flex-row mb-3">
            <a href="{{route('ouvrages.create')}}">
                <input type="button" class="button button_primary" name="ajouter" value="ajouter">
            </a>
            <form action="{{route('formulaireEnregistrementApprovisionnements')}}" method="get">
                @csrf
                <input type="submit" class="button button_primary" name="approvisionement" value="approvisionner">
            </form>
            <form action="{{ route('exporter_ouvrages') }}" method="get">
                @csrf
                <input type="submit" class="button button_primary" name="export" value="Exporter">
            </form>
            {{-- <form action="{{route('imprimerCote')}}" method="get">
                @csrf
                <input type="submit" class="button button_show" name="export" value="Cotes QR codes">
            </form> --}}
        </td>
        @endif
    </div>
    @if(!empty($ouvrages))
    <div class="flex mt-3">
        <h3>Nombre d'ouvrages : {{ $nb_ouvrage ?? 0 }}</h3>
    </div>
    <div class="m-3 max-w-96 overflow-x-auto">
        <table class="fieldset_border bg-white w-12" id="ouvrages">
            <thead class="text-xs bg-white uppercase bg-gray-50 text-center">
                <tr>
                    <th class="fieldset_border" hidden>Numéro</th>
                    <th class="fieldset_border">Titre</th>
                    <th class="fieldset_border">Année apparution</th>
                    <th class="fieldset_border">Niveau</th>
                    <th class="fieldset_border">Type</th>
                    <th class="fieldset_border">Langue</th>
                    <th class="fieldset_border" hidden>Domaine</th>
                    <th class="fieldset_border">Nombre d'exemplaire</th>
                    <th class="fieldset_border">Disponibilité</th>
                    <th class="fieldset_border">Consulter</th>
                    <th class="fieldset_border">Editer</th>
                    @if(Auth::user()->hasRole('responsable'))
                    <th class="fieldset_border">Supprimer</th>
                    @endif
                </tr>
            </thead>
            <tbody class="all_data">
                @foreach($ouvrages as $ouvrage)
                <tr class="dark:text-gray-500 text-center">
                    <td class="fieldset_border" hidden>{{ $ouvrage->id_ouvrage }}</td>
                    <td class="fieldset_border uppercase"> {{ $ouvrage->titre }} </td>
                    <td class="fieldset_border"> {{ $ouvrage->annee_apparution }} </td>
                    <td class="fieldset_border"> {{ $ouvrage->niveau->libelle ?? "" }} </td>
                    <td class="fieldset_border"> {{ $ouvrage->type->libelle ?? "" }} </td>
                    <td class="fieldset_border"> {{ $ouvrage->afficherLangue }} </td>
                    <td class="fieldset_border" hidden> {{ $ouvrage->afficherDomaine }} </td>
                    <td class="fieldset_border"> {{ $ouvrage->nombre_exemplaire }} </td>
                    <td class="fieldset_border">
                        @if ($ouvrage->isAvailableInLibrary)
                        <span class="text-green-600 capitalize">disponible</span>
                        @else
                        <span class="text-red-600 capitalize">pas disponible</span>
                        @endif
                    </td>
                    <td class="fieldset_border">
                        <form action="{{route('ouvrages.show', $ouvrage)}}" method="get">
                            @csrf
                            <input type="submit" name="consulter" value="Consulter" class="button button_show">
                        </form>
                    </td>
                    <td class="fieldset_border">
                        <form action="{{route('ouvrages.edit', $ouvrage)}}" method="get">
                            @csrf
                            <input type="submit" name="editer" value="Éditer" class="button button_primary">
                        </form>
                    </td>
                    @if(Auth::user()->hasRole('responsable'))
                    <td class="fieldset_border">
                        <form id="" onclick="activeModal({{$ouvrage->id_ouvrage}})" action="{{route('ouvrages.destroy', $ouvrage)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="button" id="" name="supprimer" value="Supprimer" class="button button_delete">
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            <tbody id="result" class="result_data"></tbody>
        </table>
    </div>
    <div class="mt-8">
        {!! $ouvrages->links() !!}
    </div>
    @else
    <h3>Il n'y a aucun ouvrage.</h3>
    @endif

    </div>

<div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
<div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
    <div class="flex flex-col items-center space-y-4">
        <div id="id_message" class="text-center">
            <p>Voulez vous vraiment supprimer cet ouvrage ?</p>
        </div>
        <div class="flex flex-row space-x-8">
            <button id="btn_annuler" class="button button_show">Annuler</button>
            <form id="form_delete_confirm" action="{{url("/ouvrages")}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" id="supprimer_ouvrage_confirm" name="supprimer" value="Supprimer" class="button button_delete">
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $('#langue').on('change', () => {
        submit_form();
    });

    $('#type').on('change', () => {
        submit_form();
    });

    $('#niveau').on('change', () => {
        submit_form();
    });

    $('#domaine').on('change', () => {
        submit_form();
    });

    $('#min, #max').on('change', () => {
        submit_form();
    });

    function submit_form() {
        $('#form').submit();
    }
</script>
<script type='text/javascript' async>
    //-------------------------------------------------
    const div_modal_supprimer = document.getElementById("modal_supprimer");
    const form_confirm = document.getElementById("form_delete_confirm");
    const btn_supprimer_ouvrage_confirm = document.getElementById("supprimer_ouvrage_confirm");
    const btn_annuler = document.getElementById("btn_annuler");
    const overlay = document.getElementById('overlay_suppression');

    function stopPropagation() {
        event.preventDefault();
        event.stopPropagation();
    }

    function activeModal(id) {
        div_modal_supprimer.classList.remove("hidden");
        overlay.classList.remove('hidden');
        stopPropagation();
        form_confirm.action = `/ouvrages/${id}`;
    }

    btn_annuler.addEventListener('click', function() {
        stopPropagation();
        div_modal_supprimer.classList.add("hidden");
        overlay.classList.add('hidden');
    });
</script>
@endsection
