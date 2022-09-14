@extends('layout.ouvrage.ouvrageShow', ['ouvrage' => $ouvragesElectronique->ouvrage])
@section("stock")
    <div>
        <!-- strtolower(str_replace(' ', '_', $ouvragesElectronique->ouvrage->titre).'.pdf#toolbar=0')) -->
        <form action="{{ route('lirePDF', $ouvragesElectronique->ouvrage) }}" method="get">
            <input type="submit" value="Lire">
        </form>
    </div>
@stop

