<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Ouvrage;

class OuvrageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_ouvrages')->insert([
            'libelle' => 'Type 1',
        ]);

        DB::table('langues')->insert([
            'libelle' => 'Langue 1',
        ]);

        DB::table('natures')->insert([
            'libelle' => 'papier',
        ]);

        DB::table('niveaux')->insert([
            'libelle' => 'primaire',
        ]);

        $typeId = 1;
        $langueId = 1;
        $niveauId = 1;
        $domaineId = 1;
        $natureId = 1;

        for ($i = 1; $i <= 10; $i++) {
            DB::table('ouvrages')->insert([
                'titre' => "Titre de l'ouvrage $i",
                'mot_cle' => json_encode(["Mot clé $i"]),
                'resume' => "Résumé de l'ouvrage $i",
                'annee_apparution' => 2023,
                'lieu_edition' => "Lieu d'édition $i",
                'id_niveau' => $niveauId,
                'id_type' => $typeId,
                'image' => "/storage/books/logo.png",
                'id_langue' => $langueId,
                'ressources_externe' => "Ressources externes $i",
                'isbn' => "ISBN $i",
                'nombre_exemplaire' => 5,
                'documents' => "chemin/vers/documents$i.pdf",
                'cote' => md5(Ouvrage::all()->count()+1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('domaines')->insert([
            'libelle' => 'Domaine 6',
        ]);
        DB::table('domaines')->insert([
            'libelle' => 'Domaine 3',
        ]);

    }
}
