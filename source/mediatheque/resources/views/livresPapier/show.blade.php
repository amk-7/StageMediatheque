@extends("layout.ouvragePhysique.ouvragePhysiqueShow", ['ouvragePhysique' => $livrePapier->ouvragePhysique])

@section("particularite")
    <label>Domaine : {{ \App\Helpers\LivrePapierHelper::showArray($livrePapier->categorie, "categorie") }} </label><br>
    <label>ISBN : {{ $livrePapier->ISBN }} </label><br>
@stop

