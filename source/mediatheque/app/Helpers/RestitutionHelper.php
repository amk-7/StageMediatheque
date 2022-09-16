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

    public static function afficherBtn($restitution)
    {
        if ($restitution->etat){
            return "<input type='submit' value='Consulter' class='button button_show'>";
        } else {
            return "<input type='submit' value='Editer' class='button button_primary'>";
        }
    }
}
?>
