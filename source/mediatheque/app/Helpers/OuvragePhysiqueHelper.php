<?php

namespace App\Helpers;
use App\Models\OuvragesPhysique;

class OuvragePhysiqueHelper
{
    public static function updateOuvrage(OuvragesPhysique $ouvragePhysique, $nombre_exemplaire, $etat, $disponibilite){
        $ouvragePhysique->nombre_exemplaire = $nombre_exemplaire;
        $ouvragePhysique->etat = $etat;
        $ouvragePhysique->disponibilite = $disponibilite;
        $ouvragePhysique->save();
    }
}

?>
