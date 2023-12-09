<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public static function determinerDateRetour(String $duree_emprunt)
    {
        $nbjour = (integer) $duree_emprunt;
        $nbjour = ($nbjour * 7);
        $date_retour = Carbon::now()->addDay($nbjour);

        return $date_retour;
    }

    public static function determinerDateFinAbonnement(String $duree_emprunt)
    {
        $nbjour = (integer) $duree_emprunt;
        $date = date_create();
        date_add($date,date_interval_create_from_date_string("$nbjour days"));
        $date_retour = date_format($date, 'Y-m-d');
        return $date_retour;
    }

    public static function verifieContact(String $contact) : bool
    {
        $contact = str_replace(" ", "", trim($contact));
        $pattern = "/((9[0-36-9])|(7[019])|(2[1-7]))[0-9]{6}/";
        return preg_match($pattern, $contact)==1;
    }

    public static function extractLineToData($data) : array
    {
        $array_data = array();
        $array_data_lines = explode(';', $data);

        for ($i=0; $i<count($array_data_lines); $i++){
            $line_attributes = explode(',', $array_data_lines[$i]);
            array_push($array_data, $line_attributes);
        }
        return $array_data;
    }

    public static function afficherEtat(String $etat)
    {
        $etats = self::demanderEtat();

        return $etats[$etat];
    }

    public static function demanderEtat()
    {
        $etats = [
            4 => "Bon état",
            3 => "Mauvais état",
            2 => "Déchiré",
            1 => "Perdus"
        ];

        return $etats;
    }

    public static function afficherDate($date) : String
    {
        $date = date_format($date, 'Y-m-d');
        return $date;
    }
}
