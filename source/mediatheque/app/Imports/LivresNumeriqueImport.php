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
use Illuminate\Database\QueryException;
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
        $indice_image = 10;
        $indice_pdf = 11;

        \session(
            ["compteur" => ((int) session("compteur")+1)]
        );

        if (ImportExcelService::controlleValidite($row, $indice_titre, $indice_annee) == null){
            return null;
        };

        $ouvrage = null;
        try {
            $ouvrage = OuvrageService::ouvrageExist(strtoupper(trim($row[$indice_titre], ' ')), str_replace(' ', '', $row[$indice_annee])) ;
        } catch (QueryException $e){
            \Session(["error_id" => session("compteur")]);
            return ;
        }
        if ($ouvrage)
        {
            $ouvrageElec = OuvrageService::ouvrageNumeriqeExist($ouvrage);
            $ouvragePhys = OuvrageService::ouvragePhysiqueExist($ouvrage);
            if ($ouvrageElec != null){
                return ;
            }
            $ouvrage->image = $row[$indice_image];
            $ouvrage->save();
            //dd($ouvrage);
        } else {
            // Creation d'un ou des auteurs .
            $data_auteurs = ImportExcelService::exctratUserInfo($row[$indice_auteur]);
            $auteurs = AuteurService::enregistrerAuteur($data_auteurs);
            //dump($auteurs);

            // Creation de l'ouvrage
            $mots_cle = GlobaleService::extractLineToData($row[$indice_mot_cle])[0];

            try {
                $ouvrage = Ouvrage::create([
                    'titre'=>strtoupper(trim($row[$indice_titre], ' ')),
                    'lieu_edition'=>$row[$indice_lieu],
                    'annee_apparution'=>str_replace(' ', '', $row[$indice_annee]),
                    'type'=>ImportExcelService::formatString($row[$indice_type]),
                    'niveau' => ImportExcelService::extractLevelInfo($row[$indice_niveau]),
                    'image' => trim($row[$indice_image]),
                    'langue'=>strtolower('fran??ais'),
                    'resume'=>strtolower("pas de resum??"),
                    'mot_cle'=>ImportExcelService::formatKeyWord($row[$indice_mot_cle]),
                ]);
            } catch (QueryException $e){
                \Session(["error_id" => session("compteur")]);
                return null;
            }
            // Definire les auteurs de l'ouvrage
            OuvrageService::definireAuteur($ouvrage, $auteurs);
        }

        // Cr??ation d'un ouvrage electronique
        $ouvrageElectronique = OuvragesElectronique::create([
            'url' => trim($row[$indice_pdf]),
            'id_ouvrage' => $ouvrage->id_ouvrage,
        ]);
        $categories = GlobaleService::extractLineToData($row[$indice_domaine])[0];

        return LivresNumerique::create([
            'categorie'=> array(strtolower($row[$indice_domaine]), ""),
            'ISBN'=>strtoupper($row[$indice_isbn]),
            'id_ouvrage_electronique'=>$ouvrageElectronique->id_ouvrage_electronique,
        ]);
    }
}
