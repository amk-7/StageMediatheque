<?php

namespace App\Service;

use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaine;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;

class OuvragesPhysiqueService
{
    public static function getClassificationsDewey(){
        return [ClassificationDeweyCentaine::all(), ClassificationDeweyDizaine::all()->toJson()];
    }
    public static function enregisterOuvragePhysique(Request $request, Ouvrage $ouvrage)
    {
        $classificationDizaine = ClassificationDeweyDizaine::all()->where("id_classification_dewey_dizaine", $request["id_classification_dewey_dizaine"])->first();

        $ouvragePhysique = OuvragesPhysique::Create([
            'nombre_exemplaire' => $request["nombre_exemplaire"],
            'id_ouvrage'=>$ouvrage->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine->id_classification_dewey_dizaine
        ]);

        return $ouvragePhysique ;
    }

    public static function updateOuvrage(OuvragesPhysique $ouvragePhysique, $nombre_exemplaire){
        $ouvragePhysique->nombre_exemplaire = $nombre_exemplaire;
        $ouvragePhysique->save();
    }
}
