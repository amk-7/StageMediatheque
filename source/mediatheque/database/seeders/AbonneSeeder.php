<?php

namespace Database\Seeders;

use App\Models\Abonne;
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
        //
        $utilisateur = User::create([
            'nom' => 'Daiki',
            'prenom' => 'Aominé',
            'nom_utilisateur' => 'Daiki5',
            'email' => 'Alhassan.blog@gmail.com',
            'password' => 'moprte789654',
            'contact' => '91817907',
            'photo_profil' => 'photo.jpg',
            'adresse' => array(
                'ville' => 'Sokode',
                'quartier' => 'Lome'),
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

    }
}
