<?php

namespace App\Service;

use Illuminate\Support\Collection;

class GlobaleService
{
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
        foreach ($array_collection as $ouvrage){
            array_push($array_key, $ouvrage[$key]);
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
