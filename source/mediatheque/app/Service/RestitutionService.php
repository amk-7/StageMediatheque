<?php

namespace App\Service;

use App\Models\Emprunt;
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
}
?>
