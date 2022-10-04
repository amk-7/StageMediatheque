<?php

namespace App\Helpers;

use App\Models\Auteur;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class OuvrageHelper
{

    public static function afficherAuteurs(Ouvrage $ouvrage)
    {
        $resultat = "";
        $auteurs = $ouvrage->auteurs()->get();
       for($i=0; $i<count($auteurs)-1; $i++){
           $resultat .= $auteurs[$i]->nom.",";
       }
        $resultat .= $auteurs[count($auteurs)-1]->nom;

        return $resultat;
    }

    public static function afficherNiveau(String $niveau)
    {
       if ($niveau==1){
           return "primaire";
       }
        if ($niveau==2){
            return "collège";
        }
        if ($niveau==3){
            return "lycée";
        }
        return $niveau;
    }

}
