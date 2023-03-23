<?php

namespace App\Exports;

use App\Models\Ouvrage;
use Illuminate\Support\Collection;
use App\Models\LivresPapier;
use App\Models\OuvragesPhysique;
use App\Service\OuvrageService;
use App\Service\OuvragesPhysiqueService;
use App\Service\LivresPapierService;
use Maatwebsite\Excel\Concerns\FromCollection;
use function Livewire\str;

class OuvragesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //dd('test');
        $id_ouvrages = array();
        
        $ouvrages = Ouvrage::all();
        //dd($ouvrages);
        $liste_ouvrages = [array(
            'Numéro',
            'titre',
            //'auteur',
            'lieu_edition',
            'annee_apparution',
            'niveau',
            'type',
            'langue',
            //'nombre_exemplaire',
        )];

        //dd($liste_ouvrages);

        foreach($ouvrages as $ouvrage){
            //dd($ouvrages);
            array_push($liste_ouvrages, array(
                'Numéro' => $ouvrage->id_ouvrage,
                'titre' => $ouvrage->titre,
                //'auteur' => $ouvrage->auteur,
                'lieu_edition' => $ouvrage->lieu_edition,
                'annee_apparution' => $ouvrage->annee_apparution,
                'niveau' => $ouvrage->niveau,
                'type' => $ouvrage->type,
                'langue' => $ouvrage->langue,
                //'nombre_exemplaire' => $ouvrage->nombre_exemplaire,
            ));
        }

        return collect($liste_ouvrages);
        



    }
}
