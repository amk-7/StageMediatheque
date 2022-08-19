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

    


