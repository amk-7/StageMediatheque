<?php

namespace App\Helpers;
use App\Models\Ouvrage;

class OuvrageHelper
{
    public static function ouvrageExist(String $ISBN)
    {
       $ouvrages = Ouvrage::all()->where('ISBN',$ISBN);
       dd($ouvrages);
       dd(count($ouvrages));
       if (count($ouvrages)>0)
       {
           return true;
       }
       return false;
    }
}

?>
