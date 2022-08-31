<?php
namespace App\Helpers;
use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurHelpers
{
    public static function estVide(String $str)
    {
        if (empty(trim($str, " "))){
            return null;
        } return $str;
    }
}

?>
