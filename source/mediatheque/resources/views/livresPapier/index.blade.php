@extends('layout.template.base')
@section("livewire_styles_content")
    @livewireStyles
@stop
@section("content")
    @livewire('ouvrage.index-livre-papier-livewire', [
    'annees'=>$annees,
    'niveaus'=> $niveaus,
    'types'=>$types,
    'langues'=>$langues,
    'categories'=>$categories,
    'id_livre_papier'=>$id_livre_papier
    ])
@stop
@section("livewire_scripts_content")
    @livewireScripts
@stop


