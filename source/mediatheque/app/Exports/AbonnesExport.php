<?php

namespace App\Exports;

use App\Models\Abonne;
use App\Service\AbonneService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use function Livewire\str;

class AbonnesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $id_abonnes = array();
        foreach (session('abonnes_key') as $abonne){
            array_push($id_abonnes, $abonne['id_abonne']);
        }

        $liste = Abonne::all()->whereIn('id_abonne', $id_abonnes);
        $liste_surcharger = AbonneService::formatAbonneListForExport($liste);
        $liste = $liste_surcharger[0];

        $abonnes = array(
            [
                "nombre_abonnne" ,
                "nombre_abonnne_masculin" ,
                "nombre_abonnne_feminin" ,
                "nombre_de_non_paye" ,
            ]
        );

        array_push($abonnes, array([
            "nombre_abonnne" => count($liste),
            "nombre_abonnne_masculin" => str($liste_surcharger[1]),
            "nombre_abonnne_feminin" => str($liste_surcharger[2]),
            "nombre_de_non_paye" => str($liste_surcharger[3]),
        ]));

        array_push($abonnes, array(
            'id',
            'nom',
            'prenom',
            'nomUtilisateur',
            'email' ,
            'contact' ,
            'ville' ,
            'quartier' ,
            'numéro_maison',
            'profession',
            'cntact_a_prevenir' ,
            'type_carte',
            'numero_carte',
            'a_payer' ,
            'nombre_emprunts',
            'nombre_restitutions',
            'nombre_emprunt_non_restituer',
            'ouvrages_lue',
        ));

        array_push($abonnes, $liste);

        return collect($abonnes);
    }
}
