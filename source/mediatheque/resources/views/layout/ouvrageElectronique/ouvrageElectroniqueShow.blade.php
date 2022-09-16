@extends('layout.ouvrage.ouvrageShow', ['ouvrage' => $ouvragesElectronique->ouvrage])
@section("stock")
    <div>
        <!-- strtolower(str_replace(' ', '_', $ouvragesElectronique->ouvrage->titre).'.pdf#toolbar=0')) -->
        @if(Auth::user())
            <form action="{{ route('lirePDF', $ouvragesElectronique->ouvrage) }}" method="get">
                <input type="submit" value="Lire" class="button button_primary">
            </form>
        @endif
    </div>
@stop

