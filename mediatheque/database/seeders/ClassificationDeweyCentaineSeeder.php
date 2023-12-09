<?php

namespace Database\Seeders;

use App\Models\ClassificationDeweyCentaine;
use Illuminate\Database\Seeder;

class ClassificationDeweyCentaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassificationDeweyCentaine::create([
            'section'=> 0,
            'theme'=>"Informatique, information générale et œuvres de référence"
        ]);

        ClassificationDeweyCentaine::create([
            'section'=> 100,
            'theme'=>"Phylosophie et pyschologie"
        ]);

        ClassificationDeweyCentaine::create([
            'section'=> 200,
            'theme'=>'Religion'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 300,
            'theme'=>'Sciences sociales'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 400,
            'theme'=>'Langues'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 500,
            'theme'=>'Science naturelles et mathématiques'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 600,
            'theme'=>'Technologie (sciences appliquées)'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 700,
            'theme'=>'Arts et loisirs'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 800,
            'theme'=>'Littérature (belles-lettres) et rhétorique'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 900,
            'theme'=>'Histoire, géographie et biographies'
        ]);
    }
}
