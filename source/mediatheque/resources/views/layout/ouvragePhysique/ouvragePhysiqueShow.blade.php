@extends('layout.ouvrage.ouvrageShow', ['ouvrage' => $ouvragePhysique->ouvrage])
@section('stock')
    <label>
        <span class="label_title_sub_title">Nombre d'exemplaire :</span>
        <span class="label_show_value">{{ $ouvragePhysique->nombre_exemplaire }}</span>
    </label>
    <label>
        <span class="label_title_sub_title">Disponibilité :</span>
        <span class="label_show_value">{{ \App\Helpers\OuvragesPhysiqueHelper::formatAvaible($ouvragePhysique) }}</span>
    </label>
@stop
