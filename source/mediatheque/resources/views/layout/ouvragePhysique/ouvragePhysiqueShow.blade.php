@extends('layout.ouvrage.ouvrageShow', ['ouvrage' => $ouvragesPhysique->ouvrage])
@section('stock')
    <label>
        <span class="label_title_sub_title">Nombre d'exemplaire :</span>
        <span class="label_show_value">{{ $ouvragesPhysique->nombre_exemplaire }}</span>
    </label>
    <label class="flex">
        <span class="label_title_sub_title">Disponibilité :</span>
        <span class="label_show_value">{!! \App\Helpers\OuvragesPhysiqueHelper::afficherDisponibilite($ouvragesPhysique) !!}</span>
    </label>
@stop
