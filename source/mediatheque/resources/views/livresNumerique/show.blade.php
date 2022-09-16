@extends("layout.ouvrageElectronique.ouvrageElectroniqueShow", ['ouvragesElectronique' => $livreNumerique->ouvragesElectronique])

@section("particularite")
    <label>
        <span class="label_title_sub_title">Domaine :</span>
        <span class="label_show_value">{{ \App\Helpers\LivrePapierHelper::showArray($livreNumerique->categorie, "categorie") }}</span>
    </label>
    <label>
        <span class="label_title_sub_title">ISBN :</span>
        <span class="label_show_value">{{ $livreNumerique->ISBN }}</span>
    </label>
@stop

