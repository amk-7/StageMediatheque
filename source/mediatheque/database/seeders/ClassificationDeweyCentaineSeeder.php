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
            'theme'=>"generalites"
        ]);

        ClassificationDeweyCentaine::create([
            'section'=> 100,
            'theme'=>"phylosophie et pyschologie"
        ]);

        ClassificationDeweyCentaine::create([
            'section'=> 200,
            'theme'=>'religion'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 300,
            'theme'=>'sciences sociales'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 400,
            'theme'=>'Langues'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 500,
            'theme'=>'science naturelles et mathématiques'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 600,
            'theme'=>'technologie'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 800,
            'theme'=>'art beaux-arts et arts décoratifs'
        ]);
        ClassificationDeweyCentaine::create([
            'section'=> 900,
            'theme'=>'georaphie et histoire'
        ]);
    }
}
