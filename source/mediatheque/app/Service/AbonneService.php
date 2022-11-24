<?php

namespace App\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


use App\Models\Abonne;

class AbonneService
{
    public static function verifierSiAbonneExist($nom, $prenom){
        Abonne::all()->where('nom', $nom)->where('prenom', $prenom);
        return true;
    }

    public static function formatAbonneList(Collection $abonnes){
        $result = Abonne::all();
        $abonnes = array();
        foreach ($result as $p){
            //dump($p->utilisateur->nom, $p->getEmpruntsEnCours());
            $personne = array(
                'id'=>$p->id_abonne,
                'nom'=>$p->utilisateur->nom,
                'prenom'=>$p->utilisateur->prenom,
                'estEligible'=>count($p->getEmpruntsEnCours()) == 0 ? 'true' : 'false',
            );
            array_push($abonnes, $personne);
        }
        return $abonnes;
    }

    public static function getAbonnesWithAllAttribut()
    {
        $result = Abonne::all();
        $abonnes = AbonneService::formatAbonneList($result);
        //dd('fin');
        return $abonnes;
    }
    /**
     * @param $etat : restituer ou non restituté
     */
    public static function recherche($etat, $nom){
        $abonnes = Abonne::all()->where('nom', 'like', '%'.$nom.'%');
        $abonnes = AbonneService::formatAbonneList($abonnes);
        
        /*$abonnes_final = array();

        str_contains($etat, $a["estEligible"]);*/

        return $abonnes;

        //Fonction qui retourne la liste des id des abonnes et on la met dans Emprunt controller
    }

    //Fonction qui retourne la liste des id des abonnes

    public static function getAbonnesId(){
        $abonnes = Abonne::all();
        $abonnesId = array();
        foreach ($abonnes as $abonne){
            array_push($abonnesId, $abonne->id_abonne);
        }
        return $abonnesId;
    }

}





