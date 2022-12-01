<?php

namespace App\Exports;

use App\Models\Abonne;
use App\Service\AbonneService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbonnesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $abonnes = array([
            "nombre_abonnne" ,
            "nombre_abonnne_masculin" ,
            "nombre_abonnne_feminin" ,
            "nombre_de_non_paye" ,
        ]);

        array_push($abonnes, array([
            "nombre_abonnne" => 53,
            "nombre_abonnne_masculin" => 43,
            "nombre_abonnne_feminin" => 10,
            "nombre_de_non_paye" => 3,
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
        ));

        array_push($abonnes, AbonneService::formatAbonneListForExport());

        return collect($abonnes);
    }
}
