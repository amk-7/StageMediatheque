<?php

namespace App\Service;

use App\Models\Emprunt;
use App\Models\LignesEmprunt;
use App\Models\Restitution;

class RestitutionService
{
    public static function etatRestitution($id_emprunt, $nb_lignes_restitution)
    {
        $emprunt = Emprunt::find($id_emprunt);
        //dd($emprunt);
        $nb_lignes_emprunt = (integer) $emprunt->nombreOuvrageEmprunte;
        $nb_lignes_restitution = (integer) $nb_lignes_restitution;
        if ($nb_lignes_restitution < $nb_lignes_emprunt){
            return false;
        } return true;
    }

    public static function etatRestitutionUpdate($restitution)
    {
        $lignes_emprunt = LignesEmprunt::all()->where('id_emprunt', $restitution->id_emprunt);
        foreach ($lignes_emprunt as $ligne)
        {
            if (! $ligne->disponibilite)
            {
                return false;
            }
        }
        return true;
    }

    public static function restitutionsPartiel()
    {
        $restitutions = Restitution::all()->where('etat', 0);
        return $restitutions;
    }
}
?>
