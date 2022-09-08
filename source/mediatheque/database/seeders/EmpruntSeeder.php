<?php

namespace Database\Seeders;

use App\Models\Emprunt;
use App\Models\LignesEmprunt;
use Illuminate\Database\Seeder;

class EmpruntSeeder extends Seeder
{
    public function run()
    {
        $emprunt = Emprunt::create([
            'date_emprunt' => '2022-09-06',
            'date_retour' => '2022-09-20',
            'id_abonne' => 1,
            'id_personnel' => 1
        ]);

        LignesEmprunt::create([
            'id_ouvrage_physique' => 1,
            'id_emprunt' => $emprunt->id_emprunt,
            'etat_sortie' => 4,
            'disponibilite' => false
        ]);
        LignesEmprunt::create([
            'id_ouvrage_physique' => 2,
            'id_emprunt' => $emprunt->id_emprunt,
            'etat_sortie' => 3,
            'disponibilite' => false
        ]);

        $emprunt = Emprunt::create([
            'date_emprunt' => '2022-09-07',
            'date_retour' => '2022-09-14',
            'id_abonne' => 1,
            'id_personnel' => 1
        ]);

        LignesEmprunt::create([
            'id_ouvrage_physique' => 3,
            'id_emprunt' => $emprunt->id_emprunt,
            'etat_sortie' => 4,
            'disponibilite' => false
        ]);
    }
}

?>
