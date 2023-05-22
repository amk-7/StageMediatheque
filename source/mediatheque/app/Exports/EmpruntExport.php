<?php

namespace App\Exports;

use App\Helpers\ReservationHelper;
use App\Models\Emprunt;
use App\Service\GlobaleService;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmpruntExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $id_emprunts = array();
        //dd(session('emprunts_key'));
        foreach (session('emprunts_key') as $emprunt){
            array_push($id_emprunts, $emprunt['id_emprunt']);
        }
        $emprunts = Emprunt::all()->whereIn('id_emprunt', $id_emprunts);
        //dd($emprunts);
        $lise_emprunt = [array(
            'Numéro', 'Date Emprunt', 'Date Restitution', 'Remise',
            'Nombre ouvrage', 'abonne', 'personnel',
        )];
        //dd($lise_emprunt);
        foreach ($emprunts as $emprunt){
            //dd($emprunt);
            array_push($lise_emprunt, array([
                'Numéro' => $emprunt->id_emprunt,
                'Date Emprunt' => GlobaleService::afficherDate($emprunt->date_emprunt),
                'Date Restitution' => GlobaleService::afficherDate($emprunt->date_retour),
                'Remise' => $emprunt->getJourRestantAttribute() < 0 ? "Enretard" : "A jours",
                'Nombre ouvrage' => $emprunt->nombreOuvrageEmprunte,
                'abonne' => $emprunt->abonne->utilisateur->userFullName,
                'personnel' => $emprunt->personnel->utilisateur->userFullName,
            ]));
        }
        return collect($lise_emprunt);
    }
}
