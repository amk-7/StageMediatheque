<?php

namespace App\Service;

use App\Helpers\OuvrageHelper;
use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurService
{
    public static function enregistrerAuteur(Array $data_auteurs)
    {
        //dump($data_auteurs);
        $auteurs = [];
        foreach ($data_auteurs as $info_auteur){
            if (! is_array($info_auteur)){
                $auteur = self::auteur(strtoupper($info_auteur), strtolower(""));
                if (! $auteur){
                    $auteur = Auteur::Create([
                        "nom"=>trim(strtoupper($info_auteur)),
                        "prenom"=>trim(strtolower("")),
                    ]);
                }
                array_push($auteurs, $auteur);
            } else if (!empty($info_auteur[0])){
                $auteur = self::auteur(strtoupper($info_auteur[0]), strtolower($info_auteur[1] ?? ""));
                if (! $auteur){
                    $auteur = Auteur::Create([
                        "nom"=>trim(strtoupper($info_auteur[0])),
                        "prenom"=>trim(strtolower($info_auteur[1] ?? "")),
                    ]);
                }
                array_push($auteurs, $auteur);
            }
        }
        //dd($auteurs);
        //dd("Auteur error");
        return $auteurs;
    }

    public static function auteur(String $nom, string $prenom)
    {
        $auteur = Auteur::all()->where("nom", trim(strtoupper($nom)))->where("prenom", trim(strtolower($prenom)))->first();
        return $auteur ;
    }
}
