<?php

namespace App\Service;

use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

class GlobaleService
{
    public static function verifieCart(String $carte) : bool
    {
        $carte = str_replace(" ", "", trim($carte));
        $pattern1 = "/([1-9]{4})(-)([1-9]{3})(-)([1-9]{4})/";
        return preg_match($pattern1, $carte)==1;
    }

    public static function verifieContact(String $contact) : bool
    {
        $contact = str_replace(" ", "", trim($contact));
        $pattern = "/((9[0-36-9])|(7[019])|(2[1-7]))[0-9]{6}/";
        return preg_match($pattern, $contact)==1;
    }
    public static function determinerDateFinAbonnement(String $duree_emprunt)
    {
        $nbjour = (integer) $duree_emprunt;
        $date = date_create();
        date_add($date,date_interval_create_from_date_string("$nbjour days"));
        $date_retour = date_format($date, 'Y-m-d');
        return $date_retour;
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

    public static function afficherDate($date) : String
    {
        $date = date_format($date, 'Y-m-d');
        return $date;
    }

    public static function getArrayKeyFromDBResult(Collection $collection, $key)
    {
        $array_collection = $collection->toArray();
        $array_key = array();
        foreach ($array_collection as $elt){
            $elt = (array) $elt;
            array_push($array_key, $elt[$key]);
        }
        return $array_key;
    }

    public static function formatString($chaine, $size)
    {
        $format_id = "";
        $string_size = $size;
        $id_ouvrage_size = strlen($chaine);
        $nb_zeros = $string_size - $id_ouvrage_size;
        if ($nb_zeros == 0){
            return $chaine;
        }
        for($i=0; $i < $nb_zeros; $i++)
        {
            $format_id .= "0";
        }
        $format_id .= $chaine;
        return $format_id;
    }
}
