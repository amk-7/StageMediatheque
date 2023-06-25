<?php

namespace App\Imports;

use App\Models\Auteur;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use App\Service\AuteurService;
use App\Service\ImportExcelService;
use App\Service\OuvrageService;
use App\Service\OuvragesPhysiqueService;
use Illuminate\Database\QueryException;
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
        $indice_image_path = 11;

        $row[$indice_titre] = str_replace("'", "-", $row[$indice_titre]);

        \session(
            ["compteur" => ((int) session("compteur")+1)]
        );

        if (ImportExcelService::controlleValidite($row, $indice_titre, $indice_annee) == null){
            return null;
        };
        $ouvrage = null;
        $annee = str_replace(' ', '', $row[$indice_annee])== '' ? 0 : str_replace(' ', '', $row[$indice_annee]);
        $annee = str_contains(strtolower($annee), 'pas') ? 0 : $annee ;
        if (! is_numeric($annee)) {
            $annee = 0;
        }
        $ouvrage = OuvrageService::ouvrageExist(strtolower(trim($row[$indice_titre], ' ')), str_replace(' ', '', $annee), str_replace(' ', '', $row[$indice_lieu]));

        if ($ouvrage)
        {
            $ouvragePhys = OuvrageService::ouvragePhysiqueExist($ouvrage);
            if ($ouvragePhys != null){
                $ouvragePhys->nombre_exemplaire += $row[$indice_nombre_exemplaire];
                $ouvragePhys->save();
                return LivresPapier::all()->where('id_ouvrage_physique', $ouvragePhys->id_ouvrage_physique)->first();
            }
            dump("Ouvrage physique non trouvé");
            dd($ouvrage);
        } else {
            //dd($ouvrage);
            try {
                //$data_auteurs = ImportExcelService::exctratUserInfo($row[$indice_auteur]);//
                $auteurs = AuteurService::enregistrerAuteur($row[$indice_auteur]);
                $chemin_image = ($row[$indice_image_path] ?? null) == null ? "default_book_image.png" : $row[$indice_image_path];
                $ouvrage = Ouvrage::create([
                    'titre'=>strtolower(trim($row[$indice_titre], ' ')),
                    'lieu_edition'=>$row[$indice_lieu],
                    'annee_apparution'=> $annee ,
                    'type'=>ImportExcelService::formatString($row[$indice_type] ?? ""),
                    'niveau' => ImportExcelService::extractLevelInfo($row[$indice_niveau] ?? "1"),
                    'image' => $chemin_image,
                    'langue'=>strtolower('français'),
                    'resume'=>strtolower("pas de resumé"),
                    'mot_cle'=>ImportExcelService::formatKeyWord($row[$indice_mot_cle] ?? ""),
                ]);
                // Definire les auteurs de l'ouvrage
                OuvrageService::definireAuteur($ouvrage, $auteurs);

                // Création d'un ouvrage physique
                $cote = OuvragesPhysiqueService::genererCoteNouvelleOuvrage("livre_papier", "COT", [$ouvrage->auteurs()->first()], $ouvrage);

                $ouvragePhysique = OuvragesPhysique::Create([
                    'nombre_exemplaire' => $row[$indice_nombre_exemplaire]+0,
                    'id_ouvrage'=>$ouvrage->id_ouvrage,
                    'cote' => $cote,
                    'id_classification_dewey_dizaine'=>null,
                ]);
            } catch (QueryException $e){
                dd($e);
                dump(session("compteur"));
                \Session(["error_id" => session("compteur")]);
                return null;
            }
        }


        return LivresPapier::create([
            'categorie'=>array(strtolower($row[$indice_domaine]), ""),
            'isbn'=>$row[$indice_isbn],
            'id_ouvrage_physique'=>$ouvragePhysique->id_ouvrage_physique
        ]);
    }

}
