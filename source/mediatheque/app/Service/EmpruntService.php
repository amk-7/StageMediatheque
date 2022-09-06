<?php 

namespace App\Service;

use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\Emprunt;
use App\Models\OuvragesPhysique;


class EmpruntService
{
    public static function enregistrerUnEmprunt($datas, $emprunt)
    {
        $datas = GobaleService::extractLineToData($datas);
        for ($i=0; $i<count($datas)-1; $i++){
            self::enregistrerUnEmpruntOuvrage($datas[$i][0], $datas[$i][1], $emprunt);
        }
    }

    public static function enregistrerUnEmpruntOuvrage($id_ouvrage_physique, $etat_sortie, $emprunt)
    {
        $ouvrage_physique = OuvragesPhysique::find($id_ouvrage_physique);
        //utiliser la methode décrementer
        $emprunt->ouvragePhysiques()->attach(
            $ouvrage_physique->id_ouvrage_physique,
            [
                'etat_sortie' => array_search($etat_sortie, OuvragesPhysiqueHelper::demanderEtat()),
                'disponibilite' => false
            ]
        );
    }
}












?>