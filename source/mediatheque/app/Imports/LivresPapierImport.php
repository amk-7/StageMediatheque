<?php

namespace App\Imports;

use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use App\Service\AuteurService;
use App\Service\GlobaleService;
use App\Service\ImportExcelService;
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

        $size = 11;

        if (ImportExcelService::controlleValidite($row, $indice_titre, $indice_annee) == null){
            return null;
        };

        $ouvrage = OuvrageService::ouvrageExist(strtoupper(trim($row[$indice_titre], ' ')), str_replace(' ', '', $row[$indice_annee])) ;
        if ($ouvrage)
        {
            $ouvrageElec = OuvrageService::ouvrageNumeriqeExist($ouvrage);
            $ouvragePhys = OuvrageService::ouvragePhysiqueExist($ouvrage);
            if ($ouvragePhys != null){
                return ;
            }
        } else {
            $data_auteurs = ImportExcelService::exctratUserInfo($row[$indice_auteur]);
            $auteurs = AuteurService::enregistrerAuteur(array($data_auteurs));

            // Creation de l'ouvrage
            $chemin_image = "default_book_image.png";

            $ouvrage = Ouvrage::create([
                'titre'=>strtoupper(trim($row[$indice_titre], ' ')),
                'lieu_edition'=>$row[$indice_lieu],
                'annee_apparution'=>str_replace(' ', '', $row[$indice_annee]),
                'type'=>ImportExcelService::formatString($row[$indice_type]),
                'niveau' => ImportExcelService::extractLevelInfo($row[$indice_niveau]),
                'image' => $chemin_image,
                'langue'=>strtolower('français'),
                'resume'=>strtolower("pas de resumé"),
                'mot_cle'=>ImportExcelService::formatKeyWord($row[$indice_mot_cle]),
            ]);
            // Definire les auteurs de l'ouvrage
            OuvrageService::definireAuteur($ouvrage, $auteurs);
        }


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

}
