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
            $auteur = AuteurHelpers::auteur($request["nom"], $request["prenom"]);
            if($auteur == null){
                $auteur = Auteur::Create([
                    "nom"=>strtoupper($request["nom"]),
                    "prenom"=>strtolower($request["prenom"])
                ]);
            }
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
             $auteur = AuteurHelpers::auteur($attributs_auteur[0], $attributs_auteur[1]);
             if($auteur == null){
                 $auteur = Auteur::Create([
                     "nom"=>strtoupper($attributs_auteur[0]),
                     "prenom"=>strtolower($attributs_auteur[1]),
                 ]);
             }
             array_push($liste_auteurs, $auteur);
         }

         //dd($liste_auteurs);
         return $liste_auteurs;
    }

    public static function auteur(String $nom, string $prenom)
    {
        $auteur = Auteur::all()->where("nom", $nom)->where("preonm", $prenom)->first();
        return $auteur ;
    }

    public static function estVide(String $str)
    {
        if (empty(trim($str, " "))){
            return null;
        } return $str;
    }
}










?>
