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
        //$this->call(LivreNumeriqueSeeder::class);
    }
}
