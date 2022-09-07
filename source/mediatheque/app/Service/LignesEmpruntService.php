<?php

namespace App\Service;

use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\Approvisionnement;
use App\Models\Emprunt;
use App\Models\LignesEmprunt;
use App\Models\OuvragesPhysique;
use App\Models\Restitution;

class LignesEmpruntService
{
    public static function enregistrerRestitutionOuvrages($data, $id_personnel, $id_abonne)
    {
        $data = GobaleService::extractLineToData($data);
        for ($i=0; $i<count($data)-1; $i++){
           if ($id_personnel != null && $id_abonne != null){
               self::enregistrerUneRestitutionOuvrage($data[$i][0], $data[$i][1], $id_personnel, $id_abonne);
           }
        }
    }

    public static function enregistrerUneRestitutionOuvrage($id_ouvrage, $etat_ouvrage, $id_personnel, $id_abonne){
        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $id_ouvrage)->first();
        $etat_ouvrage = array_search($etat_ouvrage, OuvragesPhysiqueHelper::demanderEtat());
        if ((int) $etat_ouvrage == 1){
            $ouvragePhysique->decrementerNombreExemplaire();
        } else {
            $ouvragePhysique->augmenterNombreExemplaire(1);
        }
        $restitution = Restitution::create([
            'date_restitution' => date('d-m-Y'),
            'id_abonne' => $id_abonne,
            'id_personnel'=>$id_personnel,
        ]);
        $restitution->ouvragePhysiques()->attach(
            $ouvragePhysique->id_ouvrage_physique,
            [
                'etat_ouvrage' => '' ,
            ]
        );
    }

    public static function getAllLignesEmpruntByEmprunt(Emprunt $emprunt)
    {
        $lignes_emprunt = [];
        $lignes_emprunt_by_emprunt = LignesEmprunt::all()->where('id_emprunt', $emprunt->id_emprunt);

        foreach ($lignes_emprunt_by_emprunt as $ligne){
            $fullLine = [
                "numero_ligne" => $ligne->id_ligne_emprunt,
                "numero_emprunt" => $ligne->id_emprunt,
                "numero_ouvrage_physique" => $ligne->id_ouvrage_physique,
                "etat_sortie" => OuvragesPhysiqueHelper::afficherEtat($ligne->etat_sortie),
                "titre_ouvrage" => $ligne->ouvragesPhysique->ouvrage->titre,
                "cote" => $ligne->ouvragesPhysique->cote,
            ];
            array_push($lignes_emprunt, $fullLine);
        }
        return $lignes_emprunt;
    }
}

