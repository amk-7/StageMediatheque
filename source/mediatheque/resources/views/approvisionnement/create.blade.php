@extends("layout.base")
@section("livewire_style_content")
    @livewireStyles
@stop

@section("livewire_script_content")
    @livewireScripts
@stop

@section("content")
    <h1>Approvisionnement d'un ouvrage</h1>
    <form action="{{ route("enregistementApprovisionnement") }}" method="post">
        @csrf
        @livewire('approvisionement.create', [
        'ouvragesPhysique' => $ouvragesPhysique,
        'personnels' => $personnels
        ])
        <input type="submit" name="action_approvisionnement" value="Approvisionner">
    </form>
@stop
