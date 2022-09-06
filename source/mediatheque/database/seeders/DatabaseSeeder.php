<?php

namespace Database\Seeders;

use App\Models\LivresNumerique;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ClassificationDeweyCentaineSeeder::class);
        $this->call(ClassificationDeweyDizaineSeeder::class);
        $this->call(LivrePapierSeeder::class);
<<<<<<< HEAD
        $this->call(PersonnelSeeder::class);
        $this->call(AbonneSeeder::class);
        $this->call(RestitutionSeeder::class);
        //$this->call()
=======
        //$this->call(PersonnelSeeder::class);
        //$this->call(AbonneSeeder::class);
        //$this->call(RestitutionSeeder::class);
>>>>>>> c370710ccee409c579cc8da503131b87f3cddb28
        //$this->call(LivreNumeriqueSeeder::class);
    }
}
