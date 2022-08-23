<?php

namespace App\Helpers;

use App\Models\Ouvrage;

class OuvrageHelper
{
    public static function afficherAuteurs(Ouvrage $ouvrage){
        $resultat = "";
        $auteurs = $ouvrage->auteur()->get();
        foreach ($auteurs as $auteur){
            //dd($auteur);
            $resultat .= $auteur->nom."|";
        }

        return $resultat;
    }
}
