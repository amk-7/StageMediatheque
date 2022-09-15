<?php

namespace App\Service;

use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\LignesEmprunt;
use App\Models\LignesRestitution;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;

class LignesRestitutionService
{
    public static function enregistrerLignesRestitution($datas, $id_restitution, $id_emprunt)
    {
        //dd($id_restitution, $id_emprunt, $datas);
        for ($i=1; $i < count($datas)-1; $i++){
            self::enregistrerUneLigneRestitution($datas[$i][0], $datas[$i][1], $id_restitution, $id_emprunt);
        }
    }

    public static function enregistrerUneLigneRestitution($id_ouvrage, $etat_entree, $id_restitution, $id_emprunt)
    {
        $etat_entree = trim($etat_entree) ;
        if ($etat_entree == '-'){
            //dd($etat_entree);
            return;
        }
        //dd("What...");
        $ouvrage = Ouvrage::find($id_ouvrage);
        $ouvrage_physique = OuvragesPhysique::all()->where('id_ouvrage', $ouvrage->id_ouvrage)->first();
        //dd($ouvrage_physique->id_ouvrage_physique);
        LignesRestitution::create([
            'id_ouvrage_physique' => $ouvrage_physique->id_ouvrage_physique,
            'id_restitution' => $id_restitution,
            'etat_entree' => array_search($etat_entree, OuvragesPhysiqueHelper::demanderEtat()),
        ]);
        $ligne_emprunt = LignesEmprunt::all()->where('id_emprunt', $id_emprunt)->first();
        $ligne_emprunt->updateDisponibilite();
    }
}

?>
