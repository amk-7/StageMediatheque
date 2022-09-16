<?php

namespace Database\Seeders;

use App\Models\Auteur;
use App\Models\ClassificationDeweyDizaine;
use App\Models\LivresNumerique;
use App\Models\Ouvrage;
use App\Models\OuvragesElectronique;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LivreNumeriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auteur5 = Auteur::find(1);
        $ouvrage5 = Ouvrage::Create([
            'titre'=>'ouvrage test',
            'niveau' => '1',
            'type'=>'roman',
            'image' => 'default_book_image.png',
            'langue'=>'français',
            'annee_apparution'=>'1998',
            'lieu_edition'=>'LOME',
            'mot_cle' => [
                ""
            ],
        ]);

        $ouvrage5->auteurs()->attach($auteur5->id_auteur);

        $ouvrageNumeri = OuvragesElectronique::create([
            'url'=>'ouvrage_test',
            'id_ouvrage'=>$ouvrage5->id_ouvrage,
        ]);

        LivresNumerique::Create([
            'categorie'=> array(
                "français",
                "",
            ),
            'ISBN'=>'ISBNLN001',
            'id_ouvrage_electronique'=>$ouvrageNumeri->id_ouvrage_electronique
        ]);
    }
}
