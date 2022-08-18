<?php

namespace App\Helpers;
use App\Models\User;

class UtilisateurHelper
{
    public static function verifierSiUtilisateurExist($nom, $prenom){
        User::all()->where('nom', $nom)->where('', '');
        return true;
    }
}

