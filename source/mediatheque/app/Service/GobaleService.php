<?php

namespace App\Service;

class GobaleService
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
}
