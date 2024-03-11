<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Liquide;

class AbonnementsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $id_liquides = session()->get('id_liquides');
        $liquides = Liquide::whereIn('id_liquide', $id_liquides)->get();
        $total = 0;
        $total_actif = 0;
        $registrations = [];

        foreach ($liquides as $liquide) {
            $registration = [
                'Abonnée' => $liquide->registration->abonne->utilisateur->userFullName,
                'Tarif' => $liquide->registration->tarifAbonnement->designation,
                'Date début' => $liquide->registration->date_debut->format('Y-m-d'),
                'Date fin' => $liquide->registration->date_fin->format('Y-m-d'),
                'Etat' => $liquide->registration->etat==0 ? "Expiré" : "Actif",
            ];

            if ($liquide->registration->etat==1) {
                $total_actif = $total_actif + $liquide->registration->tarifAbonnement->tarif;
            }
            $total  = $total + $liquide->registration->tarifAbonnement->tarif;

            $registrations[] = $registration;

        }

        $data = [
            [
                'Abonnée',
                'Tarif',
                'Date début',
                'Date fin',
                'Etat',
            ],
            $registrations,
            [
                '',
                '',
                '',
                '',
            ],
            [
                '',
                '',
                '',
                '',
            ],
            [
                '',
                '',
                'Total Actif',
                $total_actif,
            ],
            [
                '',
                '',
                'Total',
                $total,
            ]
        ];
        return \collect($data);
    }
}
