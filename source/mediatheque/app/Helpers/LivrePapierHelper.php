<?php

namespace App\Helpers;
use App\Models\LivresPapier;
use App\Models\OuvragesPhysique;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Array_;

class LivrePapierHelper
{

    public static function showArray(Array $array, String $keyName){
        //dd($array);
        $string = "";
        for($i=0; $i<count($array)-1; $i++){
            $string .= $array["$keyName$i"].",";
        }
        $last = count($array)-1;
        $string .= $array["$keyName$last"];
        return $string;
    }
}

?>
