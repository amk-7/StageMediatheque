<?php

namespace App\Service;

use App\Models\Personnel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PersonnelService
{
    public static function getIDPersonnelByUserName($nom)
    {
        $id_personnes = DB::table("users")
                            ->select('id_utilisateur')
                            ->where('nom', $nom)
                            ->get();
        $id_personnes = self::getArrayFromBDListe($id_personnes);
        return $id_personnes;
    }

    public static function getArrayFromBDListe($list)
    {
        $new_liste = array();
        foreach ($list as $l){
            array_push($new_liste, $l->id_utilisateur);
        }
        return $new_liste;
    }

    public static function getPersonnelWithAllAttribut()
    {
        $result = Personnel::all();
        $personnels = array();
        foreach ($result as $p){
            $personne = array(
                'id_personnel'=>$p->id_personnel,
                'nom'=>$p->utilisateur->nom,
                'prenom'=>$p->utilisateur->prenom,
            );
            array_push($personnels, $personne);
        }
        return $personnels;
    }
}
