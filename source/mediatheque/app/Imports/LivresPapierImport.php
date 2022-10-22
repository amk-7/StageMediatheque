<?php

namespace App\Imports;

use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use App\Service\AuteurService;
use App\Service\GlobaleService;
use App\Service\OuvrageService;
use App\Service\OuvragesPhysiqueService;
use Maatwebsite\Excel\Concerns\ToModel;

class LivresPapierImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $indice_auteur = 1;
        $indice_titre = 2;
        $indice_mot_cle = 3;
        $indice_isbn = 4;
        $indice_lieu = 5;
        $indice_annee = 6;
        $indice_nombre_exemplaire = 7;
        $indice_type = 8;
        $indice_domaine = 9;
        $indice_niveau = 10;
        
        for($i=0; $i<11; $i++){
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

        $data_auteurs = self::exctratUserInfo($row[$indice_auteur]);

        $auteurs = AuteurService::enregistrerAuteur(array($data_auteurs));

        // Creation de l'ouvrage
        $chemin_image = "default_book_image.png";


        $ouvrage = Ouvrage::create([
            'titre'=>strtoupper(trim($row[$indice_titre], ' ')),
            'lieu_edition'=>$row[$indice_lieu],
            'annee_apparution'=>str_replace(' ', '', $row[$indice_annee]),
            'type'=>self::formatString($row[$indice_type]),
            'niveau' => self::extractLevelInfo($row[$indice_niveau]),
            'image' => $chemin_image,
            'langue'=>strtolower('français'),
            'resume'=>strtolower("pas de resumé"),
            'mot_cle'=>self::formatKeyWord($row[$indice_mot_cle]),
        ]);
        // Definire les auteurs de l'ouvrage
        OuvrageService::definireAuteur($ouvrage, $auteurs);

        // Création d'un ouvrage physique
        $cote = OuvragesPhysiqueService::genererCoteNouvelleOuvrage("livre_papier", "COT", [$ouvrage->auteurs()->first()], $ouvrage);

        $ouvragePhysique = OuvragesPhysique::Create([
            'nombre_exemplaire' => $row[$indice_nombre_exemplaire],
            'id_ouvrage'=>$ouvrage->id_ouvrage,
            'cote' => $cote,
            'id_classification_dewey_dizaine'=>null,
        ]);

        return LivresPapier::create([
            'categorie'=>[strtolower($row[$indice_domaine]), ""],
            'ISBN'=>$row[$indice_isbn],
            'id_ouvrage_physique'=>$ouvragePhysique->id_ouvrage_physique
        ]);
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
