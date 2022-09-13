<?php

namespace App\Service;

use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\Approvisionnement;
use App\Models\Emprunt;
use App\Models\LignesEmprunt;
use App\Models\LignesRestitution;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use App\Models\Restitution;

class LignesEmpruntService
{
    public static function enregistrerLignesEmprunt($datas, $emprunt)
    {
        $datas = GlobaleService::extractLineToData($datas);
        for ($i=0; $i<count($datas)-1; $i++){
            self::enregistrerUneLignesEmprunt($datas[$i][0], $datas[$i][1], $emprunt);
        }
    }

    public static function enregistrerUneLignesEmprunt($id_ouvrage, $etat_sortie, $emprunt)
    {
        $ouvrage = Ouvrage::find($id_ouvrage);
        $ouvrage_physique = OuvragesPhysique::all()->where('id_ouvrage', $ouvrage->id_ouvrage)->first();
        $ouvrage_physique->decrementerNombreExemplaire();
        LignesEmprunt::create([
            'etat_sortie' => array_search($etat_sortie, OuvragesPhysiqueHelper::demanderEtat()),
            'disponibilite' => false,
            'id_ouvrage_physique' => $ouvrage_physique->id_ouvrage_physique,
            'id_emprunt' => $emprunt->id_emprunt,
        ]);
    }

    public static function getAllLignesEmpruntByEmprunt(Emprunt $emprunt)
    {
        $lignes_emprunt = [];
        $lignes_emprunt_by_emprunt = LignesEmprunt::all()->where('id_emprunt', $emprunt->id_emprunt)->sortBy('id_emprunt');
        $restitution = Restitution::all()->where('id_emprunt', $emprunt->id_emprunt)->first();

        foreach ($lignes_emprunt_by_emprunt as $ligne){
           if ($ligne->disponibilite){
               $etat_entree = LignesRestitution::all()->where('id_restitution', $restitution->id_restitution)
                                                ->first()->etat_entree;
               $etat_entree =  OuvragesPhysiqueHelper::afficherEtat($etat_entree);
           }

            $fullLine = [
                'numero_ligne' => $ligne->id_ligne_emprunt,
                'numero_emprunt' => $ligne->id_emprunt,
                'numero_ouvrage_physique' => $ligne->id_ouvrage_physique,
                'etat_sortie' => OuvragesPhysiqueHelper::afficherEtat($ligne->etat_sortie),
                'etat_entree' => $etat_entree ?? "",
                'titre_ouvrage' => $ligne->ouvragesPhysique->ouvrage->titre,
                'cote' => $ligne->ouvragesPhysique->cote,
                'disponibilite' => $ligne->disponibilite,
            ];
            array_push($lignes_emprunt, $fullLine);
        }
        return $lignes_emprunt;
    }
}

