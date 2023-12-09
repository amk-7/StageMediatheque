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
            'designation' => "secondaire",
            'tarif' => 200,
            'duree_validite' => 279,
        ]);

        TarifAbonnement::create([
            'designation' => "supérieure",
            'tarif' => 500,
            'duree_validite' => 279,
        ]);
    }
}
?>
