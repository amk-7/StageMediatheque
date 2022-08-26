<?php

namespace App\Helpers;
use App\Models\LivresPapier;
use App\Models\OuvragesPhysique;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Array_;

class LivrePapierHelper
{
    public static function getCategories(){
        $categories = [
            'français', 'anglais', 'allemand', 'physique', 'education',
            'hydrolique', 'musique et art', 'théologie', 'philosophie', 'zoologie', 'géologie', 'mathématique générale',
            'bibliographie', 'physique', 'médécine', 'comptabilité', 'droit'
        ];

        return $categories;
    }
    public static function livrePapierExist(String $ISBN, String $titre, int $annee_apparution)
    {
        $livre = LivresPapier::all()->where('ISBN',$ISBN)->first();
        $ouvrage = OuvrageHelper::ouvrageExist($titre, $annee_apparution);

        if ($livre==null){
            if ($ouvrage==null){
                return null;
            }
            $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage", $ouvrage->id_ouvrage)->first();
            $livre = LivresPapier::all()->where('id_ouvrage_physque', $ouvragePhysique->id_ouvrage_physique)->first();
            return $livre;
        } return $livre;
    }

    public static function convertArrayToString(Array $array, String $keyName){
        $string = "";
        for($i=0; $i<count($array[0])-1; $i++){
            $string .= $array[0][$keyName.$i].",";
        }
        $string .= $array[0][$keyName.(count($array[0])-1)];
        return $string;
    }

    public static function showArray(Array $array, String $keyName){
        $string_array = Array([]);
        $string = "";
        $i = 0;
        foreach ($array as $a){
            echo var_dump($a);
            array_push($string_array, $a["'".$keyName.$i."'"]);
            dd($a["categorie0"]);
        }

        return $string;
    }
}

?>
