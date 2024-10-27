@extends('layouts.app')
@section('content')
@php
    $is_edit = ($approvisionnement ?? null && ($approvisionnement->id_type_ouvrage ?? null)) ? true : false;
    $title = $is_edit ? "Mise à jour l'Approvisionnement ".$approvisionnement->libelle : "Ajouter un nouvelle Approvisionnement" ;
    $action = $is_edit ? route("approvisionnements.update", $approvisionnement) : route("approvisionnements.store") ;
@endphp
<div class="flex flex-col justify-center items-center w-full ml-28 mx-12 space-y-6">
    <div class="border flex flex-col m-auto items-center margin p-6">
        <form action="{{ $action }}" method="post" class="w-full">
            @csrf
            @if($is_edit)
                @method('PUT')
            @endif
            <div class="p-12 space-y-5">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="label_title">{{ $title ?? "Approvisionnement" }}</h1>
                    <h3 class="label_title_sub_title">Date {{ date('Y-m-d') }}</h3>
                </div>
                <fieldset class="fieldset_border space-y-3">
                    <legend>Ouvrage</legend>
                    <div>
                        <div class="flex flex-col space-y-3">
                            <label for="titre_ouvrage">Titre</label>
                            <select name="titre" id="titre_ouvrage" class="w-full">
                                <option value="">Selectionner</option>
                                @foreach($ouvrages as $ouvrage)
                                    <option value="{{  $ouvrage->id_ouvrage }}">{{  $ouvrage->titre }}</option>
                                @endforeach
                            </select>
                            <span class="text-red-500 hidden" id="titre_ouvrage_error">Champs obligatoire</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-col space-y-3">
                            <label for="nombre_examplaire">Nombre d'examplaire</label>
                            <input id="nombre_examplaire" type="number" name="nombre_examplaire" class="input" value="0">
                            <span class="text-red-500 hidden" id="nombre_examplaire_error">Champs obligatoire</span>
                        </div>
                    </div>
                    <div class="flex flex-row-reverse">
                        <button type="button" name="ajouter_ouvrage" id="ajouter_ouvrage" class="button button_primary w-2/5 p-2">Ajouter</button>
                    </div>
                </fieldset>
                <div class="alert">
                    <p id="approvisionement_erreur" hidden>Veuillez ajouter cet d'ouvrage.</p>
                </div>
                <div class="flex flex-row-reverse">
                    <input type="submit" value="Enregistré" class="button button_primary">
                </div>
                <fieldset class="fieldset_border flex flex-col items-center space-y-4">
                    <legend>Liste des approvisionnements</legend>
                    <table border="1" id="liste_ouvrages" class="fieldset_border w-full">
                        <thead class="fieldset_border" >
                        <tr class="fieldset_border" >
                            <th class="fieldset_border" >N°</th>
                            <th class="fieldset_border" >Titre ouvrage</th>
                            <th class="fieldset_border" >Nombre d'examplaire</th>
                            <th class="fieldset_border" >Supprimer</th>
                        </tr>
                        </thead>
                        <tbody class="fieldset_border" id="liste_ouvrages_content">
                            
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function (){
        $('select').select2();
    })
</script>
<script>
    const titre_ouvrage_tag =  $('#titre_ouvrage');
    const nombre_examplaire_tag =  $('#nombre_examplaire');
    const liste_ouvrages_content_tag =  $('#liste_ouvrages_content')[0];
    
    const titre_ouvrage_error_tag =  $('#titre_ouvrage_error');
    const nombre_examplaire_error_tag =  $('#nombre_examplaire_error');

    let nb_rows = 1;
    
    function validateForm(){
        if (titre_ouvrage_tag.val()===""){
            titre_ouvrage_error_tag.removeClass("hidden");
            titre_ouvrage_tag.addClass("border-red-500");
            return false;
        } 

        titre_ouvrage_error_tag.addClass("hidden");
        titre_ouvrage_tag.removeClass("border-red-500");

        if (nombre_examplaire_tag.val()==0){
            nombre_examplaire_error_tag.removeClass("hidden");
            nombre_examplaire_tag.addClass("border-red-500");
            return false;
        } 
        nombre_examplaire_error_tag.addClass("hidden");
        nombre_examplaire_tag.removeClass("border-red-500");
        return true;
    }

    function cleanForm(){
        titre_ouvrage_tag.val("");
        nombre_examplaire_tag.val(0);
    }

    function deleteRow(id){
        $(`#${id}`).remove();
    }

    function addRow(_nb_rows){
        return ` <tr id="${_nb_rows}">
            <td class="fieldset_border">
                <input hidden type="text" name="ids_ouvrages[]" value="${titre_ouvrage_tag.val()}">
                <input hidden type="text" name="nombres_exemplaires[]" value="${nombre_examplaire_tag.val()}">
                ${_nb_rows}
            </td>
            <td class="fieldset_border">${titre_ouvrage_tag.find('option:selected').text()}</td>
            <td class="fieldset_border">${nombre_examplaire_tag.val()}</td>
            <td class="fieldset_border">
                <button onclick="deleteRow(${_nb_rows});" type="button" class="button button_delete">
                    Supprimer
                </button>
            </td>
        </tr>
        `;
    }

    $('#ajouter_ouvrage').on('click', function(){
        if (validateForm()===true){
            liste_ouvrages_content_tag.innerHTML += addRow(nb_rows);
            nb_rows += 1;
            cleanForm();
        }
    });

</script>
@endsection




