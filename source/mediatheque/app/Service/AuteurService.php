<?php

namespace App\Service;

use App\Helpers\OuvrageHelper;
use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurService
{
    public static function enregistrerAuteur(Request $request)
    {
        $auteurs = [];
        if(!empty($request["auteur0"]) && !empty($request["prenom"])){
            $request["nom"] = $request["auteur0"];
            $auteur = AuteurService::auteur($request["nom"], $request["prenom"]);
            if($auteur == null){
                $auteur = Auteur::Create([
                    "nom"=>strtoupper($request["nom"]),
                    "prenom"=>strtolower($request["prenom"])
                ]);
            }
            array_push($auteurs, $auteur);
        }else{
            $list_auteurs = OuvrageService::convertDataToArray($request, "auteur");
            $auteurs = AuteurService::enregistrerPlusieursAuteurs($list_auteurs);
        }

        return $auteurs;
    }
    public static function enregistrerPlusieursAuteurs(Array $auteurs)
    {
        $liste_auteurs = [];
        for($i=0; $i<count($auteurs)-1; $i++){
            $attributs_auteur = explode(",", $auteurs[$i].',');
            if(! empty($attributs_auteur[0]) and ! empty($attributs_auteur[1])){
                $auteur = AuteurService::auteur($attributs_auteur[0], $attributs_auteur[1]);
                if($auteur == null){
                    $auteur = Auteur::Create([
                        "nom"=>strtoupper($attributs_auteur[0]),
                        "prenom"=>strtolower($attributs_auteur[1]),
                    ]);
                }
                array_push($liste_auteurs, $auteur);
            }
        }
        //dd($liste_auteurs);
        return $liste_auteurs;
    }

    public static function auteur(String $nom, string $prenom)
    {
        $auteur = Auteur::all()->where("nom", trim(strtoupper($nom)))->where("prenom", trim(strtolower($prenom)))->first();
        return $auteur ;
    }
}
