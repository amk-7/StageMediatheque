<?php

namespace Database\Seeders;

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
            'nom' => 'Daiki',
            'prenom' => 'Alhasan',
            'nom_utilisateur' => 'Shin',
            'email' => 'Alhassan.blog@gmail.com',
            'mot_de_passe' => Hash::make('123456789'),
            'contact' => '+22891817907',
            'profil' => '',
            'adresse' => array(
                'ville' => 'sokodé',
                'quartier' => 'Didauré',
                'rue' => 'Boulevard de la République',
                'BP' => '31'
            ),
        ]);
    }
}
