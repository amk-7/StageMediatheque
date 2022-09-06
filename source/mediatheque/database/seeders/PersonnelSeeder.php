<?php

namespace Database\Seeders;

use App\Models\Personnel;
use App\Models\User;
use Illuminate\Database\Seeder;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $utilisateur = User::create([
            'nom' => 'Daiki',
            'prenom' => 'Alhasan',
            'nom_utilisateur' => 'Shin06',
            'numero_maison'=>'N105',
            'email' => 'Alhassan.tuto@gmail.com',
            'password' => '256398741',
            'contact' => '91767676',
            'photo_profil' => 'personne.jpg',
            'adresse' => array(
                'ville' => 'Dakar',
                'quartier' => 'Sédhiou'),
            'sexe' => 'Masculin'
        ]);
        
        Personnel::create([
            'statut' => 'Responsable',
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);
    }
}
