<?php

namespace App\Service;

use App\Models\Approvisionnement;
use App\Models\OuvragesPhysique;
class ApprovisionnementService
{

    public static function enregistrerPlusieursApprosionnement($data, $id_personnel)
    {
        $data = GobaleService::extractLineToData($data);
        for ($i=0; $i<count($data)-1; $i++){
            self::enregistrerUnApprovisionnement($data[$i][0], $data[$i][1], $data[$i][2]);
        }
    }

    public static function enregistrerUnApprovisionnement($id_ouvrage, $nombre_exemplaire, $id_personnel){
        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $id_ouvrage)->first();
        $ouvragePhysique->augmenterNombreExemplaire($nombre_exemplaire);
        $ouvragePhysique->save();
        Approvisionnement::create([
            'nombre_exemplaire' => $nombre_exemplaire,
            'date_approvisionnement' => date('d-m-Y'),
            'id_personnel'=>$id_personnel,
            'id_ouvrage_physique'=>$id_ouvrage,
        ]);
    }
}
?>
