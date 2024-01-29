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
    <table>
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
                <td class="fieldset_border"> {{ substr($approvisionnement->date_approvisioement, 0, 10) }} </td>
                <td class="fieldset_border">
                    <form action="" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="button" onclick="activeModal({{$approvisionnement->id_approvisionnement}})" value="Supprimer" class="button button_delete">
                    </form>
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
@stop
@section('js')
<script type='text/javascript' async>
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
        form_confirm.action = `/approvisionnements/${id}`;
    }

    btn_annuler.addEventListener('click', function() {
        stopPropagation();
        div_modal_supprimer.classList.add("hidden");
        overlay.classList.add('hidden');
    });
</script>
@endsection