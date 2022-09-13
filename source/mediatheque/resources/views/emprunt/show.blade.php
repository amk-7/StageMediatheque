@extends('layout.base')

@section('content')
{{--dd($emprunt->lignesEmprunts)--}}
<h1> Information sur l'emprunt </h1>

<label>
    <span class="label_title_sub_title">Date Emprunt:</span>
    <span class="label_show_value">{{ App\Service\GobaleService::afficherDate($emprunt->date_emprunt)}}</span>
</label></br>

<label>
    <span class="label_title_sub_title">Date Retour:</span>
    <span class="label_show_value">{{App\Service\GobaleService::afficherDate($emprunt->date_retour)}}</span>
</label></br>

<label>
    <span class="label_title_sub_title">Personnel :</span>
    <span class="label_show_value">{{$emprunt->personnel->utilisateur->userFullName}}</span>
</label></br>

<label>
    <span class="label_title_sub_title">Abonne :</span>
    <span class="label_show_value">{{$emprunt->abonne->utilisateur->userFullName}}</span>
</label></br>

<label>
    <span class="label_title_sub_title">Nombre Ouvrage Emprunté :</span>
    <span class="label_show_value">{{$emprunt->nombreOuvrageEmprunte}}</span>
</label></br>

<div>
    <table border="1" id="liste_restitution">
        <thead>
            <tr>
                <th>N°</th>
                <th>Cote</th>
                <th>Titre ouvrage</th>
                <th>Etat sortie</th>
                <th>Restituer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emprunt->lignesEmprunts as $empruntOuvrage)
            <tr>
                <td> {{ $loop->index+1 }} </td>
                <td> {{ $empruntOuvrage->ouvragesPhysique->cote }} </td>
                <td> {{ $empruntOuvrage->ouvragesPhysique->ouvrage->titre }} </td>
                <td> {{ \App\Helpers\OuvragesPhysiqueHelper::afficherEtat($empruntOuvrage->etat_sortie) }} </td>
                <td>
                    <input type="checkbox" name="restituer[]" value="{{$empruntOuvrage->id_ligne_emprunt}}">
                </td>

                
                
            </tr> 
            @endforeach
        </tbody>
    </table>
    </div>


@stop
