<?php

namespace App\Helpers;

use App\Models\Ouvrage;
use Illuminate\Http\Request;

class OuvrageHelper
{
    public static function afficherAuteurs(Ouvrage $ouvrage){
        $resultat = "";
        $auteurs = $ouvrage->auteurs()->get();
        foreach ($auteurs as $auteur){
            //dd($auteur);
            $resultat .= $auteur->nom."|";
        }

        return $resultat;
    }

    public static function convertDataToArray(Request $request, String $object){
        $list_objet_str = "";

        $continuer = true;
        $id = 0;
        while($continuer){
            if(! empty($request["$object$id"])){
                $list_objet_str .= $request["$object$id"].";";
                $id++;
            } else {
                $continuer = false;
            }
        }
        echo $list_objet_str;
        $liste_objects = explode(";",$list_objet_str);
        //dd($liste_objects);

        return $liste_objects;
    }
}
