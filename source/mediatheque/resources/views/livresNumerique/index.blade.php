@extends('layout.template.base')
@section("livewire_styles_content")
    @livewireStyles
@stop
@section("styles")
    <style type="text/css">

        .card{
            width: 200px;
            height: 350px;
            margin: auto;
        }
        .image {
            width: 198px;
            height: 300px;
        }
        .image img {
            width: 100%;
            height: 100%;
        }
        .label {
            padding: 10px 2%;
            justify-content: center;
            text-align: center;
        }

        .online {
            position: relative;
        }
        .online::after {
            position: absolute;
            content: "3";
            background: red;
            width: 30px;
            height: 20px;
            border-radius: 4px ;
            color: white;
            right: 0px;
            text-align: center;
        }
    </style>
@endsection
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
@section('js')
@stop
