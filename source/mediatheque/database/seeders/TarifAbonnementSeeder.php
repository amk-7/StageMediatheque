<?php
namespace Database\Seeders;

use App\Models\TarifAbonnement;
use Illuminate\Database\Seeder;

class TarifAbonnementSeeder extends Seeder
{
    public function run()
    {
        // formule 1 college, lycée
        // formule 2 etudiant, fonctionnaire, retraité

        TarifAbonnement::create([
            'designation' => "formule1",
            'tarif' => 200,
            'durreeValidite' => 279,
        ]);

        TarifAbonnement::create([
            'designation' => "formule2",
            'tarif' => 500,
            'durreeValidite' => 279,
        ]);
    }
}
?>