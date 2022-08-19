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
        $auteur = Auteur::Create([
            'nom'=>'BONI',
            'prenom'=>'nazi',
            'date_naissance'=> '01-07-1912',
            'date_decces'=>'16-06-1969'
        ]);
        /*$ouvrage = Ouvrage::Create([
           'niveau' => '1er degré',
            'type'=>'Roman',
            'image' => '',
            'langue'=>'fr',
        ]);

        $ouvrage->auteur()->attach($auteur->id_auteur, [
            'date_apparution'=>'15-11-1983',
            'lieu_edition'=>'Sokodé-TOGO',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        $classificationCentaine = ClassificationDeweyCentaine::create([
            'section'=>100,
            'theme'=>'Philosophie, psycologie'
        ]);

        $classificationDizaine = ClassificationDeweyDizaines::create([
            'classe'=>1,
            'matiere'=>'Philosophie',
            'id_classification_dewey_centaine'=>$classificationCentaine->id_classification_dewey_centaine
        ]);

        $ouvragePhysique = OuvragesPhysique::Create([
            'nombre_exemplaire' => 50,
            'etat'=>'nouveau',
            'disponibilite'=>true,
            'id_ouvrage'=>$ouvrage->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine->id_classification_dewey_dizaine
        ]);

        $livrePapier = LivresPapier::Create([
            'categorie'=> 'Litérature française',
            'ISBN'=>'12225555',
            'id_ouvrage_physique'=>$ouvragePhysique->id_ouvrage_physique

        ]);*/

        $auteur1 = Auteur::Create([
            'nom'=>'LAYE',
            'prenom'=>'Camara',
            'titre'=>'L\'enfant noir',
            'date_naissance'=> '01/01/1928',
            'date_decces'=>'04/02/1980'
        ]);

        $ouvrage1 = Ouvrage::Create([
           'niveau' => '2è degré',
            'type'=>'Roman',
            'image' => '',
            'langue'=>'Français',
        ]);

        $ouvrage1->auteur()->attach($auteur1->id_auteur, [
            'date_apparution'=>'2004',
            'lieu_edition'=>'Pocket',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        $classificationCentaine1 = ClassificationDeweyCentaine::create([
            'section'=>400,
            'theme'=>'Langue'
        ]);

        $classificationDizaine1 = ClassificationDeweyDizaines::create([
            'classe'=>440,
            'matiere'=>'Langue romane française',
            'id_classification_dewey_centaine'=>$classificationCentaine1->id_classification_dewey_centaine
        ]);

        $ouvragePhysique1 = OuvragesPhysique::Create([
            'nombre_exemplaire' => 3,
            'etat'=>'nouveau',
            'disponibilite'=>true,
            'id_ouvrage'=>$ouvrage1->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine1->id_classification_dewey_dizaine
        ]);

        $livrePapier1 = LivresPapier::Create([
            'categorie'=> 'Litérature française',
            'ISBN'=>'1',
            'id_ouvrage_physique'=>$ouvragePhysique1->id_ouvrage_physique

        ]);
    }
}


