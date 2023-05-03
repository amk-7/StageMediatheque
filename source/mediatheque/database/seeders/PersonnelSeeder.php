<?php

namespace Database\Seeders;

use App\Models\Abonne;
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
        $utilisateur = User::create([
            'nom' => 'SUP ADMIN',
            'prenom' => 'SUP ADMIN',
            'nom_utilisateur' => '_admin',
            'email' => 'abdoulmalikkondi8@gmail.com',
            'password' => Hash::make('IFNTI2023!'),
            'contact' => '93561240',
            'photo_profil' => 'profil.png',
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

        $utilisateur->assignRole([Role::find(2), Role::find(1)]);

        $utilisateur = User::create([
            'nom' => strtoupper('Shintaro'),
            'prenom' => strtolower('Midorima'),
            'nom_utilisateur' => 'daiki5',
            'email' => 'alhassan@gmail.com',
            'password' => Hash::make('123456789'),
            'contact' => '91817907',
            'photo_profil' => 'profil.png',
            'adresse' => array(
                'ville' => 'Sokode',
                'quartier' => 'Lome',
                'numero_maison' => 'N102'),
            'sexe' => 'Masculin'
        ]);

        Personnel::create([
            'statut' => 'Bibliothècaire',
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);
        $utilisateur->assignRole([Role::find(2)]);
    }
}
