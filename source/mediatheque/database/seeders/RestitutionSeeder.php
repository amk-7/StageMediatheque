<?php

namespace Database\Seeders;

use App\Models\Abonne;
use App\Models\OuvragesPhysique;
use App\Models\Personnel;
use App\Models\Restitution;
use Illuminate\Database\Seeder;

class RestitutionSeeder extends Seeder
{
    public function run(){
        $op = OuvragesPhysique::all()->first();
        $abonne = Abonne::all()->first();
        $personnel = Personnel::all()->first();

        $restitution = Restitution::create([
            'date_restitution' => date('Y-m-d'),
            'etat'=> -1,
            'id_abonne' => $abonne->id_abonne,
            'id_personnel' => $personnel->id_personnel,
        ]);

        $restitution->ouvragePhysiques()->attach(
            $op->id_ouvrage_physique,
            [
                'etat_ouvrage' => '1',
            ]
        );

        $op->decrementerNombreExemplaire();
    }
}
