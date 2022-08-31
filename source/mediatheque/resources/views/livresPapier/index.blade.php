@extends('layout.base')
@section("livewire_style_content")
    @livewireStyles
@stop
@section("livewire_style_content")
    @livewireScripts
@stop
@section("content")
    @livewire('ouvrage.index-livre-papier-livewire', [
        'livresPapiers'=>$livresPapiers
    ])
@stop


