@extends('layout.template.base')

@section('content')
    <div class="flex flex-col space-y-3 bg-white p-3">
        <h1 class="label_title text-center"> Information sur l'emprunt </h1>
        <div class="flex flex-col">
            <label class="">
                <span class="label_title_sub_title">Date Emprunt:</span>
                <span class="label_show_value">{{ App\Service\GlobaleService::afficherDate($emprunt->date_emprunt)}}</span>
            </label>
            <label>
                <span class="label_title_sub_title">Date Retour:</span>
                <span class="label_show_value">{{App\Service\GlobaleService::afficherDate($emprunt->date_retour)}}</span>
            </label>
            <label>
                <span class="label_title_sub_title">Personnel :</span>
                <span class="label_show_value">{{$emprunt->personnel->utilisateur->userFullName}}</span>
            </label>
            <label>
                <span class="label_title_sub_title">Abonne :</span>
                <span class="label_show_value">{{$emprunt->abonne->utilisateur->userFullName}}</span>
            </label>
            <label>
                <span class="label_title_sub_title">Nombre Ouvrage Emprunté :</span>
                <span class="label_show_value">{{$emprunt->nombreOuvrageEmprunte}}</span>
            </label>
        </div>
        <div>
            <table border="1" id="liste_restitution" class="fieldset_border" >
                <thead class="fieldset_border" >
                <tr class="fieldset_border" >
                    <th class="fieldset_border" >N°</th>
                    <th class="fieldset_border" >Cote</th>
                    <th class="fieldset_border" >Titre ouvrage</th>
                    <th class="fieldset_border" >Etat sortie</th>
                </tr>
                </thead>
                <tbody class="fieldset_border" >
                @foreach($emprunt->lignesEmprunts as $ligne)
                    <tr class="fieldset_border" >
                        <td class="fieldset_border" > {{ $loop->index+1 }} </td>
                        <td class="fieldset_border" > {{ $ligne->ouvrage->cote }} </td>
                        <td class="fieldset_border" > {{ $ligne->ouvrage->titre }} </td>
                        <td class="fieldset_border" > {{ \App\Helpers\OuvragesPhysiqueHelper::afficherEtat($ligne->etat_sortie) }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop


