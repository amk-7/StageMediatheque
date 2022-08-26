<?php
namespace App\Helpers;
use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurHelpers
{
    public static function enregistrerAuteur(Request $request)
    {
        $auteurs = [];
        if(!empty($request["auteur0"]) && !empty($request["prenom"])){
            $request["nom"] = $request["auteur0"];
            $auteur = Auteur::Create([
                "nom"=>$request["nom"],
                "prenom"=>$request["prenom"],
                "date_naissance"=>$request["date_naissance"],
                "date_decces"=>$request["date_decces"]
            ]);
            array_push($auteurs, $auteur);
        }else{
            $list_auteurs = OuvrageHelper::convertDataToArray($request, "auteur");
            $auteurs = AuteurHelpers::enregistrerPlusieursAuteurs($list_auteurs);
        }

        return $auteurs;
    }
    public static function enregistrerPlusieursAuteurs(Array $auteurs)
    {
         $liste_auteurs = [];
         for($i=0; $i<count($auteurs)-1; $i++){
             $attributs_auteur = explode(",", $auteurs[$i]);

             $auteur = Auteur::Create([
                 "nom"=>$attributs_auteur[0],
                 "prenom"=>$attributs_auteur[1],
                 "date_naissance"=>AuteurHelpers::estVide($attributs_auteur[2]),
                 "date_decces"=>AuteurHelpers::estVide($attributs_auteur[3])
             ]);
             array_push($liste_auteurs, $auteur);
         }

         //dd($liste_auteurs);
         return $liste_auteurs;
    }

    public static function estVide(String $str)
    {
        if (empty(trim($str, " "))){
            return null;
        } return $str;
    }
}










?>
