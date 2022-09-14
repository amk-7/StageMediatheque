<?php

namespace App\Helpers;

class RestitutionHelper
{
    public static function afficherEtatREstitution($restitution)
    {
        if ($restitution->etat){
            return "<td>Complet</td>";
        } else {
            return "<td>Partiel</td>";
        }
    }
}
?>
