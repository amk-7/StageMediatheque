<?php

namespace App\Helpers;

use App\Models\Abonne;


class AbonneHelper
{
    public static function verifierSiAbonneExist($nom, $prenom){
        Abonne::all()->where('nom', $nom)->where('prenom', $prenom);
        return true;
    }
}


