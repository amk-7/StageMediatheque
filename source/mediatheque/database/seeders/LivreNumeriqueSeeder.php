<?php

namespace Database\Seeders;

use App\Models\Auteur;
use App\Models\ClassificationDeweyDizaines;
use App\Models\LivresNumerique;
use App\Models\Ouvrage;
use App\Models\OuvragesElectronique;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LivreNumeriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auteur5 = Auteur::Create([
            'nom'=>'BONI',
            'prenom'=>'nazi',
            'date_naissance'=> '01-07-1912',
            'date_decces'=>'16-06-1969'
        ]);
        $ouvrage5 = Ouvrage::Create([
            'titre'=>'Crepuscule des temps anciens EPA',
            'niveau' => '3è degré',
            'type'=>'roman',
            'image' => '',
            'langue'=>'Français',
        ]);

        $ouvrage5->auteur()->attach($auteur5->id_auteur, [
            'annee_apparution'=>'1994',
            'lieu_edition'=>'DAKAR',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        $ouvrageNumeri = OuvragesElectronique::create([
            'url'=>'path',
            'id_ouvrage'=>$ouvrage5->id_ouvrage,
        ]);

        LivresNumerique::Create([
            'categorie'=> 'français',
            'ISBN'=>'12225555',
            'id_ouvrage_electronique'=>$ouvrageNumeri->id_ouvrage_electronique
        ]);
    }
}
