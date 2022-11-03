<?php

namespace App\Imports;

use App\Models\LivresNumerique;
use App\Models\Ouvrage;
use App\Models\OuvragesElectronique;
use App\Service\AuteurService;
use App\Service\GlobaleService;
use App\Service\ImportExcelService;
use App\Service\OuvragesElectroniqueService;
use App\Service\OuvrageService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;

class LivresNumeriqueImport implements ToModel
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
        $indice_type = 7;
        $indice_domaine = 8;
        $indice_niveau = 9;

        $size = 10;

        $name = str_replace(" ", "_", trim($row[$indice_titre], ' '));

        if (ImportExcelService::controlleValidite($row, $indice_titre, $indice_annee, $size) == null){
            return null;
        };

        // Creation d'un ou des auteurs .
        $data_auteurs = ImportExcelService::exctratUserInfo($row[$indice_auteur]);
        $auteurs = AuteurService::enregistrerAuteur(array($data_auteurs));


        // Creation de l'ouvrage
        $mots_cle = GlobaleService::extractLineToData($row[$indice_mot_cle])[0];

        $chemin_image = $name.".jpg";

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

        // Création d'un ouvrage electronique
        $chemin_ouvrage = $name ;
        $ouvrageElectronique = OuvragesElectronique::create([
            'url' => $chemin_ouvrage,
            'id_ouvrage' => $ouvrage->id_ouvrage,
        ]);
        $categories = GlobaleService::extractLineToData($row[$indice_domaine])[0];

        return LivresNumerique::create([
            'categorie'=>$categories,
            'ISBN'=>strtoupper($row[$indice_isbn]),
            'id_ouvrage_electronique'=>$ouvrageElectronique->id_ouvrage_electronique,
        ]);
    }
}
