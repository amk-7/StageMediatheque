<?php

namespace App\Service;

use App\Models\Abonne;


class AbonneService
{
    public static function verifierSiAbonneExist($nom, $prenom){
        Abonne::all()->where('nom', $nom)->where('prenom', $prenom);
        return true;
    }
}


