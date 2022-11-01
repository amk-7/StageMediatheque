<?php

namespace App\Service;

use App\Models\Abonne;

class AbonneService
{
    public static function verifierSiAbonneExist($nom, $prenom){
        Abonne::all()->where('nom', $nom)->where('prenom', $prenom);
        return true;
    }

    public static function getAbonnesWithAllAttribut()
    {
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
        //dd('fin');
        return $abonnes;
    }


   

}





