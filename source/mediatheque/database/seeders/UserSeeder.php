<?php

namespace Database\Seeders;

use App\Models\Abonne;
use App\Models\Personnel;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'nom' => strtoupper('DAIKI'),
            'prenom' => strtolower('alhasan'),
            'nom_utilisateur' => 'Shin',
            'email' => 'Alhassan.blog@gmail.com',
            'password' => Hash::make('123456789'),
            'contact' => '+22891817907',
            'profil' => '',
            'adresse' => array(
                'ville' => 'sokodé',
                'quartier' => 'Didauré',
                'rue' => 'Boulevard de la République',
                'BP' => '31',
            'sexe' => 'Masculin'
            ),
        ]);

        $abonne = Abonne::create([
            'id_utilisateur' => $user->id_utilisateur,
            'date_naissance' => '1996-01-01',
            'niveau_etude' => 'Bac +2',
            'profession' => 'Etudiant',
            'contact_a_prevenir' => '+22891817907',
            'numero_carte' => 'MN123456789',
            'type_de_carte' => 'Etudiant'
        ]);

        $personnel = Personnel::create([
            'id_utilisateur' => $user->id_utilisateur,
            'statut' => 'Administrateur'
        ]);
    }
}
