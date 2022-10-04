<?php

namespace Database\Seeders;

use App\Models\Personnel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            'email' => 'Alhassan.tuto@gmail.com',
            'password' => Hash::make('123456789'),
            'contact' => '91767676',
            'photo_profil' => 'personne.jpg',
            'adresse' => array(
                'ville' => 'Dakar',
                'quartier' => 'Sédhiou',
                'numero_maison' => 'N108'),
            'sexe' => 'Masculin'
        ]);

        Personnel::create([
            'statut' => 'Bibliothécaire',
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);

        $utilisateur->assignRole(Role::find(2));

        $utilisateur = User::create([
            'nom' => 'KONDI ',
            'prenom' => 'Abdoul malik',
            'nom_utilisateur' => '@amk',
            'email' => 'abdoulmalikkondi8@gmail.com',
            'password' => Hash::make('amk2048'),
            'contact' => '93561240',
            'photo_profil' => 'profils.png',
            'adresse' => array(
                'ville' => 'Sokode',
                'quartier' => 'komah 2',
                'numero_maison' => ''),
            'sexe' => 'Masculin'
        ]);

        Personnel::create([
            'statut' => 'Responsable',
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);

        $utilisateur->assignRole(Role::find(1));
    }
}
