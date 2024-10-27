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
            'email' => '',
            'password' => Hash::make('IFNTI2023!'),
            'contact' => '',
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
            'nom' => strtolower('mediatheque'),
            'prenom' => strtolower('mediatheque'),
            'nom_utilisateur' => 'mediatheque',
            'email' => '',
            'password' => Hash::make('mediatheque2023!'),
            'contact' => '',
            'photo_profil' => 'profil.png',
            'adresse' => array(
                'ville' => '',
                'quartier' => '',
                'numero_maison' => ''
            ),
            'sexe' => 'Masculin'
        ]);

        Personnel::create([
            'statut' => 'Responsable',
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);

        $utilisateur->assignRole([Role::find(2), Role::find(1)]);

        $utilisateur = User::create([
            'nom' => strtolower('MEMEM'),
            'prenom' => strtolower('islam'),
            'nom_utilisateur' => 'islam',
            'email' => '',
            'password' => Hash::make('mediatheque2023!'),
            'contact' => '90915825',
            'photo_profil' => 'profil.png',
            'adresse' => array(
                'ville' => 'sokodé',
                'quartier' => 'akamadè',
                'numero_maison' => ''
            ),
            'sexe' => 'Masculin'
        ]);

        Personnel::create([
            'statut' => 'Responsable',
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);

        $utilisateur->assignRole([Role::find(2), Role::find(1)]);

        $utilisateur = User::create([
            'nom' => strtolower('napkan'),
            'prenom' => strtolower('emma'),
            'nom_utilisateur' => 'emma',
            'email' => '',
            'password' => Hash::make('emma2023!'),
            'contact' => '90780406',
            'photo_profil' => 'profil.png',
            'adresse' => array(
                'ville' => 'Sokode',
                'quartier' => 'Komah 3',
                'numero_maison' => ''
            ),
            'sexe' => 'Feminin'
        ]);

        Personnel::create([
            'statut' => 'Bibliothècaire',
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);

        $utilisateur->assignRole([Role::find(2)]);
    }
}
