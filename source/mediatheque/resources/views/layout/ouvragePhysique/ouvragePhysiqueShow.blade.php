@extends('layout.ouvrage.ouvrageShow', ['ouvrage' => $ouvragePhysique->ouvrage])
@section('stock')
    <label>Nombre d'exemplaire : {{ $ouvragePhysique->nombre_exemplaire }} </label><br>
    <label>Disponibilité : {{ \App\Helpers\OuvragesPhysiqueHelper::formatAvaible($ouvragePhysique) }} </label><br>
@stop
