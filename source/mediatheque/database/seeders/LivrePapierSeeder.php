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
            'nom'=>'KONDI',
            'prenom'=>'abdoul malik',
            'date_naissance'=> '03-04-1985',
            'date_decces'=>'05-08-2012'
        ]);
        $ouvrage = Ouvrage::Create([
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
        ]);
    }
}
