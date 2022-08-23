<?php

namespace App\Helpers;
use App\Models\LivresPapier;

class LivrePapierHelper
{
    public static function ouvrageExist(String $ISBN)
    {
       $ouvrages = LivresPapier::all()->where('ISBN',$ISBN);
       //dd($ouvrages);
       //dd(count($ouvrages));
       if (count($ouvrages)>0)
       {
           return true;
       }
       return false;
    }
}

?>
