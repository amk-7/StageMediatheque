<?php

namespace App\Service;

class ImportExcelService
{
    public static function controlleValidite($row, $indice_titre, $indice_annee, $indice)
    {
        for($i=0; $i<$indice; $i++){
            if (! $row[$i])
            {
                return null;
            }
        }

        if (in_array('N°', $row, true))
        {
            return null;
        }

        if (OuvrageService::ouvrageExist(strtoupper(trim($row[$indice_titre], ' ')), str_replace(' ', '', $row[$indice_annee])) != null)
        {
            return null;
        }

        return true;
    }

    public static function exctratUserInfo(String $auteur)
    {
        $auteur = str_replace(' ', '', $auteur);
        $auteur = str_replace('(', ',', $auteur);
        $auteur = str_replace(')', '', $auteur);
        $auteur = str_replace('-', '', $auteur);
        $auteurs = explode(',', $auteur);
        if (count($auteurs)==1)
        {
            array_push($auteurs, "");
        }
        return $auteurs;
    }

    public static function extractLevelInfo(String $niveau)
    {
        $niveau = strtolower(str_replace(' ', '', $niveau));
        if ($niveau=="université")
        {
            return $niveau;
        }
        return $niveau[0];
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
