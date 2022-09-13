@extends('layout.ouvrage.ouvrageShow', ['ouvrage' => $ouvragesElectronique->ouvrage])
@section("stock")
    <div>
        <iframe src="{{ asset('storage/ouvrage_electonique/'.strtolower(str_replace(' ', '_', $ouvragesElectronique->ouvrage->titre).'.pdf#toolbar=0')) }}"  width="100%" height="500px"></iframe>
    </div>
@stop

