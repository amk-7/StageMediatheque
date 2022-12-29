<?php

namespace App\Helpers;
use App\Models\Abonne;
use App\Models\Registration;
use App\Models\User;

class UtilisateurHelper
{
    public static function verifierSiUtilisateurExist($nom, $prenom){
        User::all()->where('nom', $nom)->where('prenom', $prenom);
        return true;
    }

    public static function showRegistrationState(Registration $registration)
    {
        if ($registration->etat == 0){
            return "<td class='fieldset_border alert'>Expiré</td>";
        } else {
            return "<td class='fieldset_border info'>Valide</td>";
        }
    }

    public static function showConfrirmProfil(Abonne $abonne)
    {
        if ($abonne->profil_valider == 0){
            return "<td class='fieldset_border alert'>Non</td>";
        } else {
            return "<td class='fieldset_border info'>Oui</td>";
        }
    }

    public static function showAonneRegistrate(Abonne $abonne)
    {
        if (! $abonne->isRegistrate()){
            return "<td class='fieldset_border alert'>Non</td>";
        } else {
            return "<td class='fieldset_border info'>Oui</td>";
        }
    }
}

