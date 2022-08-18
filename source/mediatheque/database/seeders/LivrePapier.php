<?php

namespace Database\Seeders;

use App\Models\Auteur;
use Illuminate\Database\Seeder;

class LivrePapier extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auteur = Auteur::Create([
            'nom'=>'KONDI',
            'prenom'=>'abdoul malik',
            'date_naissance'=> '03-04-1985',
            'date_decces'=>'05-08-2012'
        ]);
        /*$livrePapier = LivrePapier::Create([

        ]);*/
    }
}
