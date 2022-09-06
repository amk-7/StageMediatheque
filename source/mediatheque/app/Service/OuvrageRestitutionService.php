<?php

namespace App\Service;

use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\Approvisionnement;
use App\Models\OuvragesPhysique;
use App\Models\Restitution;

class OuvrageRestitutionService
{
    public static function enregistrerRestitutionOuvrages($data, $id_personnel, $id_abonne)
    {
        $data = GobaleService::extractLineToData($data);
        for ($i=0; $i<count($data)-1; $i++){
           if ($id_personnel != null && $id_abonne != null){
               self::enregistrerUneRestitutionOuvrage($data[$i][0], $data[$i][1], $id_personnel, $id_abonne);
           }
        }
    }

    public static function enregistrerUneRestitutionOuvrage($id_ouvrage, $etat_ouvrage, $id_personnel, $id_abonne){
        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $id_ouvrage)->first();
        $ouvragePhysique->augmenterNombreExemplaire(1);
        $restitution = Restitution::create([
            'date_restitution' => date('d-m-Y'),
            'id_abonne' => $id_abonne,
            'id_personnel'=>$id_personnel,
        ]);
        $restitution->ouvragePhysiques()->attach(
            $ouvragePhysique->id_ouvrage_physique,
            [
                'etat_ouvrage' => array_search($etat_ouvrage, OuvragesPhysiqueHelper::demanderEtat()) ,
            ]
        );
    }
}

