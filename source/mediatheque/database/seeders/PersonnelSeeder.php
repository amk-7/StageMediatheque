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
            'password' => Hash::make('256398741'),
            'contact' => '91767676',
            'photo_profil' => 'personne.jpg',
            'adresse' => array(
                'ville' => 'Dakar',
                'quartier' => 'Sédhiou',
                'numero_maison' => 'N108'),
            'sexe' => 'Masculin'
        ]);

        Personnel::create([
            'statut' => 'Responsable',
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);

        $utilisateur->assignRole(Role::find(1));
    }
}
