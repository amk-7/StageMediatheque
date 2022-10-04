<?php
namespace App\Helpers;
use App\Models\LivresNumerique;

class LivreNumeriqueHelper
{
    public static function ouvrageExist(String $ISBN)
    {
       $ouvrages = LivresNumerique::all()->where('ISBN',$ISBN);
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