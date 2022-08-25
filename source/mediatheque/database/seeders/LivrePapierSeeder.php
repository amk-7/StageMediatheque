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

        $auteur5 = Auteur::Create([
            'nom'=>'BONI',
            'prenom'=>'nazi',
            'date_naissance'=> '01-07-1912',
            'date_decces'=>'16-06-1969'
        ]);

        $auteurn = Auteur::Create([
            'nom'=>'KONDI',
            'prenom'=>'Abdoul',
            'date_naissance'=> '01-07-1912',
            'date_decces'=>'16-06-1969'
        ]);

        $ouvrage5 = Ouvrage::Create([
            'titre'=>'Crepuscule des temps anciens EPA',
            'mot_cle'=> [
                "mot_cle_0"=>"temps",
                "mot_cle_1"=>"anciens"
            ],
            'resume' => "Pas de résumé .",
            'niveau' => '3è degré',
            'type'=>'roman',
            'image' => '',
            'langue'=>'Français',
        ]);

        $ouvrage5->auteurs()->attach($auteur5->id_auteur, [
            'annee_apparution'=>'1994',
            'lieu_edition'=>'DAKAR',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
        $ouvrage5->auteurs()->attach($auteurn->id_auteur, [
            'annee_apparution'=>'1994',
            'lieu_edition'=>'DAKAR',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);



        $classificationDizaine5 = ClassificationDeweyDizaines::all()->where("classe", 10)->first();

        $ouvragePhysique5 = OuvragesPhysique::Create([
            'nombre_exemplaire' => 4,
            'etat'=>'nouveau',
            'disponibilite'=>true,
            'id_ouvrage'=>$ouvrage5->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine5->id_classification_dewey_dizaine
        ]);

        LivresPapier::Create([
            'categorie'=> 'français',
            'ISBN'=>'12225555',
            'id_ouvrage_physique'=>$ouvragePhysique5->id_ouvrage_physique
        ]);

        $auteur1 = Auteur::Create([
            'nom'=>'LAYE',
            'prenom'=>'Camara',
            'date_naissance'=> '01/01/1928',
            'date_decces'=>'04/02/1980'
        ]);

        $ouvrage1 = Ouvrage::Create([
            'titre'=>'L\'enfant noir',
           'niveau' => '2è degré',
            'type'=>'roman',
            'image' => '',
            'langue'=>'français',
        ]);

        $ouvrage1->auteurs()->attach($auteur1->id_auteur, [
            'annee_apparution'=>'2004',
            'lieu_edition'=>'Pocket',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        $classificationDizaine1 = ClassificationDeweyDizaines::all()->where("classe", 10)->first();

        $ouvragePhysique1 = OuvragesPhysique::Create([
            'nombre_exemplaire' => 3,
            'etat'=>'nouveau',
            'disponibilite'=>true,
            'id_ouvrage'=>$ouvrage1->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine1->id_classification_dewey_dizaine
        ]);

        LivresPapier::Create([
            'categorie'=> 'français',
            'ISBN'=>'1',
            'id_ouvrage_physique'=>$ouvragePhysique1->id_ouvrage_physique

        ]);
    }
}




