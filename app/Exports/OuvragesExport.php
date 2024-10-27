<?php

namespace App\Exports;

use App\Models\Ouvrage;
use Maatwebsite\Excel\Concerns\FromCollection;

class OuvragesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ouvrages = Ouvrage::all();
        $donnees = [
            'N°', 'Auteur', 'Titre (Œuvre)', 'Mots clés', 'ISBN', "Lieu d'édition", "Date de parution", 'Nombre',
            'Langues', 'Domaines', 'Type',
        ];

        $data_ouvrages = [
            $donnees,
            OuvragesExport::formatOuvrageListForExport($ouvrages, $donnees),
        ];
        return collect($data_ouvrages);
    }

    public static function formatOuvrageListForExport($ouvrages, $donnees)
    {
        $result = [];
        foreach ($ouvrages as $index=>$ouvrage) {

            $data = [
                $donnees[0] => $index,
                $donnees[1] => $ouvrage->afficherAuteurs,
                $donnees[2] => $ouvrage->titre,
                $donnees[3] => implode(',', $ouvrage->mot_cle),
                $donnees[4] => $ouvrage->isbn,
                $donnees[5] => $ouvrage->lieu_edition,
                $donnees[6] => $ouvrage->annee_apparution,
                $donnees[7] => $ouvrage->nombre_exemplaire,
                $donnees[8] => $ouvrage->afficherLangue,
                $donnees[9] => $ouvrage->afficherDomaine,
                $donnees[10] => $ouvrage->type->libelle ?? "",
            ];

            $result[] = $data;
        }

        return $result;
    }
}
