<?php

namespace App\Helpers;

use App\Models\Emprunt;
use App\Service\EmpruntService;
use App\Service\GlobaleService;

class RestitutionHelper
{
    public static function afficherDateRetoure(Emprunt $emprunt)
    {
        //dd($emprunt->empruntExpierAttribute());
        if ($emprunt->empruntExpierAttribute()){
            return "<td class='fieldset_border alert'>".GlobaleService::afficherDate($emprunt->date_retour)."</td>";
        } else {
            return "<td class='fieldset_border info'>".GlobaleService::afficherDate($emprunt->date_retour)."</td>";
        }
    }

    public static function afficherEnpruntJourRestant(Emprunt $emprunt)
    {

        if ($emprunt->getJourRestantAttribute()<0 && ! EmpruntService::etatEmprunt($emprunt)){
            return "<td class='fieldset_border alert'>".$emprunt->getJourRestantAttribute()."</td>";
        } else if($emprunt->getJourRestantAttribute()>0 && ! EmpruntService::etatEmprunt($emprunt)) {
            return "<td class='fieldset_border info'>".$emprunt->getJourRestantAttribute()."</td>";
        } else {
            return "<td class='fieldset_border info'>0</td>";
        }
    }

    public static function afficherEtatREstitution($restitution)
    {
        if ($restitution->etat){
            return "<td class='fieldset_border info'>Complet</td>";
        } else {
            return "<td class='fieldset_border alert'>Partiel</td>";
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
