<?php

namespace App\Service;

use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\LignesEmprunt;
use App\Models\LignesRestitution;

class LignesRestitutionService
{
    public static function enregistrerLignesRestitution($datas, $id_restitution, $id_emprunt)
    {
        for ($i=1; $i < count($datas)-1; $i++){
            self::enregistrerUneLigneRestitution($datas[$i][0], $datas[$i][1], $id_restitution, $id_emprunt);
        }
    }

    public static function enregistrerUneLigneRestitution($id_ouvrage_physique, $etat_entree, $id_restitution, $id_emprunt)
    {
        LignesRestitution::create([
            'id_ouvrage_physique' => $id_ouvrage_physique,
            'id_restitution' => $id_restitution,
            'etat_entree' => array_search($etat_entree, OuvragesPhysiqueHelper::demanderEtat()),
        ]);
        $ligne_emprunt = LignesEmprunt::all()->where('id_emprunt', $id_emprunt)->first();
        $ligne_emprunt->updateDisponibilite();
    }
}

?>
