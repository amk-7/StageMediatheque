@extends("layout.ouvragePhysique.ouvragePhysiqueShow", ['ouvragesPhysique' => $livrePapier->ouvragesPhysique])

@section("particularite")
    <label>
        <span class="label_title_sub_title">Domaine :</span>
        <span class="label_show_value">{{ \App\Helpers\LivrePapierHelper::showArray($livrePapier->categorie, "categorie") }}</span>
    </label>
    <label>
        <span class="label_title_sub_title">ISBN :</span>
        <span class="label_show_value">{{ $livrePapier->ISBN }}</span>
    </label>
@stop

