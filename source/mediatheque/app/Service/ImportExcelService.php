<?php

namespace App\Service;

class ImportExcelService
{
    public static function controlleValidite($row, $indice_titre, $indice_annee)
    {
        if ($row[$indice_titre]==null){
            return null;
        }

        if (in_array('N°', $row, true))
        {
            return null;
        }
        return true;
    }

    public static function exctratUserInfo(String $auteur)
    {
        $auteurs = explode(";", trim($auteur));
        if (count($auteurs)==1){
            return $auteurs;
        }
        for ($i=0; $i<count($auteurs); $i++){
            $auteurs[$i] = explode(',', $auteurs[$i]);
        }
        return $auteurs;
    }


    public static function extractLevelInfo(String $niveau)
    {
        //dd($niveau);
        $niveau = strtolower(str_replace(' ', '', $niveau));
        if ($niveau=="université")
        {
            return $niveau;
        }
        if (str_contains(strtolower($niveau), 'lycée') || str_contains(strtolower($niveau), 'l')){
            return '3';
        }
        if (str_contains(strtolower($niveau), 'collège')){
            return '2';
        }
        if (str_contains(strtolower($niveau), 'primaire')){
            return '1';
        }
        return '3';
    }

    public static function formatKeyWord(String $mot_cle)
    {
        $mots_cle = explode(',', $mot_cle);
        for($i = 0; $i < count($mots_cle); $i++)
        {
            $mots_cle[$i] = str_replace(' ', '', $mots_cle[$i]);
        }
        array_push($mots_cle, "");
        return $mots_cle;
    }
    public static function formatString(String $type) : String
    {
        $array_resultat = array();
        $type = trim($type);
        for($i=0; $i<strlen($type); $i++){
            if ($i+1 != strlen($type)){
                if ($type[$i] == " " && $type[$i+1] == " ")
                {
                    $type[$i] = "_";
                }
            }
        }
        return strtolower(str_replace("_", "", $type));
    }
}
