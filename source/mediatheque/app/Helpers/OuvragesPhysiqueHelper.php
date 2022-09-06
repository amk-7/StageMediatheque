<?php

namespace App\Helpers;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaine;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;

class OuvragesPhysiqueHelper
{
    public static function alertStock(OuvragesPhysique $ouvragesPhysique)
    {
        if ($ouvragesPhysique->nombre_exemplaire > 5)
        {
            return "<p class=''>$ouvragesPhysique->nombre_exemplaire<p>";
        } return "<p class='text-red-800'>$ouvragesPhysique->nombre_exemplaire<p>";
    }
    public static function generateCote(OuvragesPhysique $ouvragesPhysique){
        $cote = "";
        $cote .= $ouvragesPhysique->id_classification_dewey_dizaine;
        $cote .= substr("");
    }

    public static function afficherDisponibilite(OuvragesPhysique $ouvragesPhysique)
    {
        if ($ouvragesPhysique->estDisponible())
        {
            return "<p class='info'>Disponible<p>";
        } return "<p class='alert'> Pas disponible<p>";
    }
    public static function afficherEtat(String $etat)
    {
        $etats = self::demanderEtat();

        return $etats[$etat];
    }
    public static function demanderEtat()
    {
        $etats = [
            5 => "Bon état",
            4 => "Acceptable",
            3 => "Mauvais état",
            2 => "Déchiré",
            1 => "Perdus"
        ];

        return $etats;
    }

    public static function formatAvaible(OuvragesPhysique $ouvragesPhysique){
        if($ouvragesPhysique->estDisponible()){
            return "disponible";
        } return "nom disponible";
    }

}

?>
