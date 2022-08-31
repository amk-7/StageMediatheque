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
        if ($ouvragesPhysique->disponibilite)
        {
            return "<p class='text-green-800'>Disponible<p>";
        } return "<p class='text-red-800'>Disponible<p>";
    }

    public static function afficherEtat(OuvragesPhysique $ouvragesPhysique)
    {
        $etats = [
            5 => "Nouveau",
            4 => "Moins nouveau",
            3 => "Normal",
            2 => "Mauvais état",
            1 => "Très mauvais état"
        ];

        return $etats[$ouvragesPhysique->etat];
    }
    public static function demanderEtat()
    {
        $etats = [
            5 => "Nouveau",
            4 => "Moins nouveau",
            3 => "Normal",
            2 => "Mauvais état",
            1 => "Très mauvais état"
        ];

        return $etats;
    }

}

?>
