<?php

namespace App\Service;

use App\Helpers\UtilisateurHelper;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public static function enregistrerUtilisateur(Request $request)
    {
        $utilisateur = [];
        if(!empty($request["user0"]) && !empty($request["prenom"])){
            $request["nom"] = $request["user0"];
            $utilisateur = UserService::utilisateur($request["nom"], $request["prenom"]);
            if($utilisateur == null){
                $utilisateur = User::Create([
                    "nom"=>strtoupper($request["nom"]),
                    "prenom"=>ucfirst($request["prenom"])
                ]);
            }
            array_push($utilisateurs, $utilisateur);
            
        }
        else{
            $list_utilisateurs = UtilisateurHelper::convertDataToArray($request, "user");
            $utilisateurs = UserService::enregistrerPlusieursUtilisateurs($list_utilisateurs);
        }    
    }
    public static function enregistrerPlusieursUtilisateurs(Array $utilisateurs)
    {
        $liste_utilisateurs = [];
        for($i=0; $i<count($utilisateurs)-1; $i++){
            $attributs_utilisateur = explode(",", $utilisateurs[$i]);
            $utilisateur = UserService::utilisateur($attributs_utilisateur[0], $attributs_utilisateur[1]);
            if($utilisateur == null){
                $utilisateur = User::Create([
                    "nom"=>strtoupper($attributs_utilisateur[0]),
                    "prenom"=>ucfirst($attributs_utilisateur[1]),
                ]);
            }
            array_push($liste_utilisateurs, $utilisateur);
        }
        
        //dd($liste_utilisateurs);
        return $liste_utilisateurs;
    }

    public static function utilisateur(String $nom, string $prenom)
    {
        $utilisateur = User::all()->where("nom", $nom)->where("preonm", $prenom)->first();
        return $utilisateur ;
    }
}

?>