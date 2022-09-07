<?php

namespace App\Service;

use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\Emprunt;
use App\Models\LignesEmprunt;
use App\Models\OuvragesPhysique;


class EmpruntService
{
    public static function enregistrerUnEmprunt($datas, $emprunt)
    {
        $datas = GobaleService::extractLineToData($datas);
        for ($i=0; $i<count($datas)-1; $i++){
            self::enregistrerLignesEmprunt($datas[$i][0], $datas[$i][1], $emprunt);
        }
    }

    public static function enregistrerLignesEmprunt($id_ouvrage_physique, $etat_sortie, $emprunt)
    {
        $ouvrage_physique = OuvragesPhysique::find($id_ouvrage_physique);
        $ouvrage_physique->decrementerNombreExemplaire();
        //dd($emprunt->id_emprunt);
        LignesEmprunt::create([
            'etat_sortie' => array_search($etat_sortie, OuvragesPhysiqueHelper::demanderEtat()),
            'disponibilite' => false,
            'id_ouvrage_physique' => $ouvrage_physique->id_ouvrage_physique,
            'id_emprunt' => $emprunt->id_emprunt,
        ]);
    }
/*
    public static function modifierLignesEmprunt($id_ouvrage_physique, $etat_sortie, $emprunt)
    {
        $ouvrage_physique = OuvragesPhysique::find($id_ouvrage_physique);
        $ouvrage_physique->incrementerNombreExemplaire();
        //dd($emprunt->id_emprunt);
        LignesEmprunt::create([
            'etat_sortie' => array_search($etat_sortie, OuvragesPhysiqueHelper::demanderEtat()),
            'disponibilite' => false,
            'id_ouvrage_physique' => $ouvrage_physique->id_ouvrage_physique,
            'id_emprunt' => $emprunt->id_emprunt,
        ]);
    }*/
}





?>
