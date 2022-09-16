<?php
namespace App\Helpers;

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
