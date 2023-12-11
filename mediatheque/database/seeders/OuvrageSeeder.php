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
        $libelles = array(
            "Roman",
            "Nouvelle",
            "Essai",
            "Poésie",
            "Drame",
            "Biographie",
            "Autobiographie",
            "Mémoires",
            "Thriller",
            "Science-fiction",
            "Fantasy",
            "Historique",
            "Documentaire",
            "Roman",
            "Document Pédagogique",
            "document technique",
            "Manuel scolaire",
            "Nouvelles",
            "Bande dessinée",
        );;
        foreach($libelles as $libelle){
            DB::table('types_ouvrages')->insert([
                'libelle' => strtolower($libelle),
            ]);
        }

        $libelles = ["français", "anglais", "allemend"];
        foreach($libelles as $libelle){
            DB::table('langues')->insert([
                'libelle' => strtolower($libelle),
            ]);
        }

        $libelles = ["primaire", "collège", "lycée", "université"];
        foreach($libelles as $libelle){
            DB::table('niveaux')->insert([
                'libelle' => strtolower($libelle),
            ]);
        }

        $libelles = array(
            "Littérature classique",
            "Philosophie",
            "Psychologie",
            "Science",
            "Histoire",
            "Politique",
            "Religion",
            "Art",
            "Économie",
            "Sociologie",
            "Sciences humaines",
            "Sciences naturelles",
            "Technologie",
            "Éducation",
            "Santé",
            "Physique",
            "Mathématique Générale",
            "Technique",
            "Energie Solaire",
            "Géologie",
            "Comptabilité",
            "Education",
            "Anglais",
            "Français",
            "Allemand",
            "Droit",
            "Théologie",
            "Médecine",
            "Musique",
        );

        foreach($libelles as $libelle){
            DB::table('domaines')->insert([
                'libelle' => strtolower($libelle),
            ]);
        }


        // $typeId = 1;
        // $langueId = 1;
        // $niveauId = 1;

        // for ($i = 1; $i <= 10; $i++) {
        //     DB::table('ouvrages')->insert([
        //         'titre' => "Titre de l'ouvrage $i",
        //         'mot_cle' => json_encode(["Mot clé $i"]),
        //         'resume' => "Résumé de l'ouvrage $i",
        //         'annee_apparution' => 2023,
        //         'lieu_edition' => "Lieu d'édition $i",
        //         'id_niveau' => $niveauId,
        //         'id_type' => $typeId,
        //         'image' => "/storage/books/logo.png",
        //         'id_langue' => $langueId,
        //         'ressources_externe' => "Ressources externes $i",
        //         'isbn' => "ISBN $i",
        //         'nombre_exemplaire' => 5,
        //         'documents' => "chemin/vers/documents$i.pdf",
        //         'cote' => md5(Ouvrage::all()->count()+1),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

    }
}
