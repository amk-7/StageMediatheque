<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleHasPermissionSeeder::class,
        ]);
         //\App\Models\User::factory(10)->create();
        $this->call(ClassificationDeweyCentaineSeeder::class);
        $this->call(ClassificationDeweyDizaineSeeder::class);
        $this->call(PersonnelSeeder::class);
        $this->call(AbonneSeeder::class);
        $this->call(OuvrageSeeder::class);
        $this->call(TarifAbonnementSeeder::class);
        //$this->call(RestitutionSeeder::class);
    }
}
