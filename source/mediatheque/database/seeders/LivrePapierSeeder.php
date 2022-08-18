<?php

namespace Database\Seeders;

use App\Models\Auteur;
use App\Models\AuteursParOuvrage;
use App\Models\Ouvrage;
use App\Models\OuvragePhysique;
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
            'langue'=>'fr'
        ]);

        /*$auteurParOuvrage = AuteursParOuvrage::Create([
            'id_auteur'=>$auteur->id_auteur,
            'id_ouvrage'=>$ouvrage->id_ouvrage,
            'date_apparution'=>'15-11-1983',
            'lieu_edition'=>'Sokodé-TOGO'
        ]);*/

        /*$ouvragePhysique = OuvragePhysique::Create([
            'nombre_exemplaire' => 50,
            'etat'=>'nouveau',
            'disponibilite'=>true,
            'id_ouvrage'=>$ouvrage->id_ouvrage,
            'id_classification_dewey_dizaine'=>''
        ]);*/
        /*$livrePapier = LivrePapier::Create([
            'categorie'=>
        ]);*/
    }
}
