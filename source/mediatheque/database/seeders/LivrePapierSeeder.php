<?php

namespace Database\Seeders;

use App\Models\Auteur;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaines;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LivrePapierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
            'date_apparution'=>'1994',
            'lieu_edition'=>'DAKAR',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        $classificationCentaine5 = ClassificationDeweyCentaine::create([
            'section'=>0,
            'theme'=>'inconnue'
        ]);

        $classificationDizaine5 = ClassificationDeweyDizaines::create([
            'classe'=>0,
            'matiere'=>'inconnue',
            'id_classification_dewey_centaine'=>$classificationCentaine5->id_classification_dewey_centaine
        ]);

        $ouvragePhysique5 = OuvragesPhysique::Create([
            'nombre_exemplaire' => 4,
            'etat'=>'nouveau',
            'disponibilite'=>true,
            'id_ouvrage'=>$ouvrage5->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine5->id_classification_dewey_dizaine
        ]);

        $livrePapier5 = LivresPapier::Create([
            'categorie'=> 'français',
            'ISBN'=>'12225555',
            'id_ouvrage_physique'=>$ouvragePhysique5->id_ouvrage_physique
        ]);
    }
}

