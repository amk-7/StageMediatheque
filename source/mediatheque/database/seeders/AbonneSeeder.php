<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AbonneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nom'=>"DERMANE",
            'prenom'=>"fad",
            'nomUtilisateur'=>'dermanfad',
            'email'=>'dermanefad@gmail.com',
            'password'=>"123456789",
            'contact'=>"000000000",
            'profil'=>'',
            'adresse'=>array(
                'ville'=>"sokode",
                'quartier'=>"komah"
            ),
            'sexe'=>"masculin"
        ]);


    }
}
