<?php

namespace Database\Seeders;

use App\Models\Abonne;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AbonneSeeder extends Seeder
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
            'nom' => 'Shintaro',
            'prenom' => 'Midorima',
            'nom_utilisateur' => 'Daiki5',
            'email' => 'Alhassan.blog@gmail.com',
            'password' => Hash::make('moprte789654'),
            'contact' => '91817907',
            'photo_profil' => 'profil.png',
            'adresse' => array(
                'ville' => 'Sokode',
                'quartier' => 'Lome',
                'numero_maison' => 'N102'),
            'sexe' => 'Masculin'
        ]);

        Abonne::create([
            'date_naissance' => '1996-01-01',
            'niveau_etude' => 'Université',
            'profession' => 'Etudiant',
            'contact_a_prevenir' => '92817907',
            'numero_carte' => '123456789',
            'type_de_carte' => 'Identité',
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);

        $utilisateur2 = User::create([
            'nom' => 'Tchabana',
            'prenom' => 'Hafiz',
            'nom_utilisateur' => 'Haf',
            'email' => 'hafiz@gmail.com',
            'password' => Hash::make('123456789'),
            'contact' => '90229029',
            'photo_profil' => 'profil.png',
            'adresse' => array(
                'ville' => 'Dakar',
                'quartier' => 'Sédhiou',
                'numero_maison' => 'N108'),
            'sexe' => 'Masculin',
        ]);

        Abonne::create([
            'date_naissance' => '1996-01-01',
            'niveau_etude' => 'Université',
            'profession' => 'Etudiant',
            'contact_a_prevenir' => '90303030',
            'numero_carte' => '912345678',
            'type_de_carte' => 'Identité',
            'id_utilisateur' => $utilisateur2->id_utilisateur
        ]);

        $utilisateur3 = User::create([
            'nom' => 'Tabate',
            'prenom' => 'Daniel',
            'nom_utilisateur' => 'James',
            'email' => 'Daniel@gmail.com',
            'password' => Hash::make('123456789'),
            'contact' => '91919191',
            'photo_profil' => 'profil.png',
            'adresse' => array(
                'ville' => 'Sokode',
                'quartier' => 'Komah',
                'numero_maison' => 'N201'),
            'sexe' => 'Masculin',
        ]);

        Abonne::create([
            'date_naissance' => '2003-04-11',
            'niveau_etude' => 'Université',
            'profession' => 'Etudiant',
            'contact_a_prevenir' => '92353698',
            'numero_carte' => '932345678',
            'type_de_carte' => 'Identité',
            'id_utilisateur' => $utilisateur3->id_utilisateur
        ]);



        $utilisateur->assignRole(Role::find(3));
        $utilisateur2->assignRole(Role::find(3));
        $utilisateur3->assignRole(Role::find(3));

    }
}
