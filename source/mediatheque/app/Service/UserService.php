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
        if(!empty($request["utilisateur0"]) && !empty($request["prenom"])){
            $request["nom"] = $request["utilisateur0"];
            $utilisateur = UserService::utilisateur($request["nom"], $request["prenom"]);
            if($utilisateur == null){
                $utilisateur = User::Create([
                    "nom"=>strtoupper($request["nom"]),
                    "prenom"=>ucfirst($request["prenom"])
                ]);
            }
            array_push($utilisateurs, $utilisateur);
            
        }    
    }

    public static function utilisateur(String $nom, string $prenom)
    {
        $utilisateur = User::all()->where("nom", $nom)->where("preonm", $prenom)->first();
        return $utilisateur ;
    }
}

?>