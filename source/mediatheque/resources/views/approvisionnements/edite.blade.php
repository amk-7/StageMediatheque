@extends("layout.template.base")
@section("livewire_styles_content")
    @livewireStyles
@stop
@section("livewire_scripts_content")
    @livewireScripts
@stop
@section("content")
    @livewire('approvisionnement.edite-approvisionement-livewire', [
    'personnels'=>$personnels,
    'ouvragesPhysique'=>$ouvragesPhysique,
    'approvisionnement'=>$approvisionnement,
    ])
@stop
