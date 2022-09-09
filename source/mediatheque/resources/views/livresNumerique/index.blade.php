@extends('layout.base')
@section("livewire_styles_content")
    @livewireStyles
@stop
@section("content")
    @livewire('ouvrage.index-livre-numerique-livewire', [
    'annees'=>$annees,
    'niveaus'=> $niveaus,
    'types'=>$types,
    'langues'=>$langues,
    'categories'=>$categories,
    'id_livre_numerique'=>$id_livre_numerique
    ])
@stop
@section("livewire_scripts_content")
    @livewireScripts
@stop
