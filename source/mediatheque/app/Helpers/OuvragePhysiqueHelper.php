<?php

namespace App\Helpers;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaine;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;

class OuvragePhysiqueHelper
{
    public static function getClassificationsDewey(){
        return [ClassificationDeweyCentaine::all(), ClassificationDeweyDizaine::all()->toJson()];
    }
    public static function enregisterOuvragePhysique(Request $request, Ouvrage $ouvrage)
    {
        $classificationDizaine = ClassificationDeweyDizaine::all()->where("id_classification_dewey_dizaine", $request["id_classification_dewey_dizaine"])->first();

        $ouvragePhysique = OuvragesPhysique::Create([
            'nombre_exemplaire' => $request["nombre_exemplaire"],
            'etat'=>$request["etat"],
            'disponibilite'=>true,
            'id_ouvrage'=>$ouvrage->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine->id_classification_dewey_dizaine
        ]);

        return $ouvragePhysique ;
    }

    public static function updateOuvrage(OuvragesPhysique $ouvragePhysique, $nombre_exemplaire, $etat, $disponibilite){
        $ouvragePhysique->nombre_exemplaire = $nombre_exemplaire;
        $ouvragePhysique->etat = $etat;
        $ouvragePhysique->disponibilite = $disponibilite;
        $ouvragePhysique->save();
    }

    public static function formatAvaible(OuvragesPhysique $ouvragesPhysique){
        if($ouvragesPhysique->disponibilite){
            return "disponible";
        } return "nom disponible";
    }
    public static function generateCote(OuvragesPhysique $ouvragesPhysique){
        $cote = "";
        $cote .= $ouvragesPhysique->id_classification_dewey_dizaine;
        $cote .= substr("");
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
}

?>
