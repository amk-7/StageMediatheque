<?php

namespace Database\Seeders;

use App\Models\Auteur;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaine;
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
        ]);

        $auteurn = Auteur::Create([
            'nom'=>'KONDI',
            'prenom'=>'abdoul',
        ]);

        $ouvrage5 = Ouvrage::Create([
            'titre'=>'CREPUSCUL DES TEMPS ANCIEN EPA',
            'mot_cle'=> array(
                "temps",
                "anciens",
                ""
            ),
            'resume' => "pas de résumé .",
            'niveau' => '3',
            'type'=>'roman',
            'image' => 'default_book_image.png',
            'langue'=>'français',
        ]);

        $ouvrage5->auteurs()->attach($auteur5->id_auteur, [
            'annee_apparution'=>'1994',
            'lieu_edition'=>'DAKAR',
        ]);
        $ouvrage5->auteurs()->attach($auteurn->id_auteur, [
            'annee_apparution'=>'1994',
            'lieu_edition'=>'DAKAR',
        ]);



        $classificationDizaine5 = ClassificationDeweyDizaine::all()->where("classe", 10)->first();

        $ouvragePhysique5 = OuvragesPhysique::Create([
            'nombre_exemplaire' => 4,
            'id_ouvrage'=>$ouvrage5->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine5->id_classification_dewey_dizaine
        ]);

        LivresPapier::Create([
            'categorie'=> array(
                "français",
                ""
            ),
            'ISBN'=>'12225555',
            'id_ouvrage_physique'=>$ouvragePhysique5->id_ouvrage_physique
        ]);

        $auteur1 = Auteur::Create([
            'nom'=>'LAYE',
            'prenom'=>'camara'
        ]);

        $ouvrage1 = Ouvrage::Create([
                'titre'=>"L'ENFANT NOIR",
            'mot_cle'=> [
               "temps",
                ""
            ],
            'resume' => "pas de résumé .",
           'niveau' => '2',
            'type'=>'nouvelle',
            'image' => 'default_book_image.png',
            'langue'=>'anglais',
        ]);

        $ouvrage1->auteurs()->attach($auteur1->id_auteur, [
            'annee_apparution'=>'2004',
            'lieu_edition'=>'Pocket',
        ]);

        $classificationDizaine1 = ClassificationDeweyDizaine::all()->where("classe", 10)->first();

        $ouvragePhysique1 = OuvragesPhysique::Create([
            'nombre_exemplaire' => 3,
            'id_ouvrage'=>$ouvrage1->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine1->id_classification_dewey_dizaine
        ]);

        LivresPapier::Create([
            'categorie'=> array(
               "français",
                "anglais",
                ""
            ),
            'ISBN'=>'1',
            'id_ouvrage_physique'=>$ouvragePhysique1->id_ouvrage_physique

        ]);
    }
}




