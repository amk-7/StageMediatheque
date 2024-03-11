@extends('layouts.app')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="label_title">Liste des approvisionnements</h1>
    <div class="mt-3 mb-3 flex flex-col justify-start">
        <form method="GET" action="{{ route('formulaireEnregistrementApprovisionnements') }}">
            <input type="submit" value="Ajouter" class="button button_primary">
        </form>
    </div>
    @if(! empty($approvisionnements ?? "") and $approvisionnements->count() >0)
    <table class="bg-white">
        <thead>
            <tr>
                <th class="fieldset_border">Numero</th>
                <th class="fieldset_border">Ouvrage</th>
                <th class="fieldset_border">ISBN</th>
                <th class="fieldset_border">Nombre exempalire</th>
                <th class="fieldset_border">Nom</th>
                <th class="fieldset_border">Prenom</th>
                <th class="fieldset_border">Date</th>
                <th class="fieldset_border">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($approvisionnements as $approvisionnement)
            <tr>
                <td class="fieldset_border"> {{ $approvisionnement->id_approvisionnement }} </td>
                <td class="fieldset_border"> {{ $approvisionnement->ouvrage->titre }} </td>
                <td class="fieldset_border">{{ $approvisionnement->ouvrage->isbn }}</td>
                <td class="fieldset_border"> {{ $approvisionnement->nombre_exemplaire }} </td>
                <td class="fieldset_border"> {{ $approvisionnement->personnel->utilisateur->nom }} </td>
                <td class="fieldset_border"> {{ $approvisionnement->personnel->utilisateur->prenom }} </td>
                <td class="fieldset_border"> {{ substr($approvisionnement->date_approvisionnement, 0, 10) }} </td>
                <td class="fieldset_border">
                    <div class="flex space-x-3">
                        <input type="button" onclick="activeModifierModal('{{$approvisionnement->id_approvisionnement}}', '{{$approvisionnement->ouvrage->titre}}', '{{ $approvisionnement->nombre_exemplaire }}')" value="Modifier" class="button button_primary">
                        <input type="button" onclick="activeModal('{{$approvisionnement->id_approvisionnement}}')" value="Supprimer" class="button button_delete">
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h2>Aucun approvisionnement</h2>
    @endif
</div>
<div style="z-index:1000" id="overlay_suppression" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>
<div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_supprimer">
    <div class="flex flex-col items-center space-y-4">
        <div id="id_message" class="text-center">
            <p>Voulez vous vraiment supprimer cet approvisionnement ?</p>
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
<div style="z-index:1001" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg" id="modal_modifer">
    <div class="flex flex-col items-center space-y-4">
        <div id="" class="text-center">
            <p id="title_modification">Modifier l'approvisionnement N°</p>
        </div>
        <div class="flex flex-row space-x-8">
            <form id="form_modifier" action="" method="post">
                @csrf
                @method('PUT')
                <div class="flex flex-col items-center space-y-3">
                    <p id="ouvrage_title"></p>
                    <input name="nombre_exemplaire" id="app_quantite" type="number" value="" class="input">
                    <div class="flex items-center space-x-3">
                        <button id="btn_annuler2" type="button" class="button button_show">Annuler</button>
                        <input type="submit" id="btn_modifier_ouvrage_confirm" name="modifer" value="modifer" class="button button_primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script type='text/javascript' async>
    const div_modal_supprimer = document.getElementById("modal_supprimer");
    const form_confirm = document.getElementById("form_delete_confirm");
    const btn_supprimer_ouvrage_confirm = document.getElementById("supprimer_ouvrage_confirm");
    const btn_annuler = document.getElementById("btn_annuler");

    const overlay = document.getElementById('overlay_suppression');

    const div_modal_modifer = document.getElementById('modal_modifer');
    const form_modifier = document.getElementById("form_modifier");
    const btn_modifier_ouvrage_confirm = document.getElementById("btn_modifier_ouvrage_confirm");
    const btn_annuler2 = document.getElementById("btn_annuler2");
    const title_modification = document.getElementById("title_modification");

    const ouvrage_title = document.getElementById("ouvrage_title");
    const app_quantite = document.getElementById("app_quantite");


    function stopPropagation() {
        event.preventDefault();
        event.stopPropagation();
    }

    function activeModal(id) {
        div_modal_supprimer.classList.remove("hidden");
        overlay.classList.remove('hidden');
        stopPropagation();
        form_confirm.action = `/approvisionnements/${id}/`;
    }

    btn_annuler.addEventListener('click', function() {
        stopPropagation();
        div_modal_supprimer.classList.add("hidden");
        overlay.classList.add('hidden');
    });

    function activeModifierModal(id, title, quantity) {
        stopPropagation();
        div_modal_modifer.classList.remove("hidden");
        overlay.classList.remove('hidden');
        title_modification.innerText = `Modifier l'approvisionnement N° ${id}`;
        ouvrage_title.innerText = title
        app_quantite.value = quantity
        form_modifier.action = `/modification_approvisionnements/${id}/`;
    }

    btn_annuler2.addEventListener('click', function() {
        stopPropagation();
        div_modal_modifer.classList.add("hidden");
        overlay.classList.add('hidden');
    });
</script>
@endsection
