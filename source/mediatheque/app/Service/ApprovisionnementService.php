<?php

namespace App\Service;

use App\Models\Approvisionnement;
use App\Models\OuvragesPhysique;
use App\Models\Personnel;
use Illuminate\Support\Facades\Auth;

class ApprovisionnementService
{

    public static function enregistrerPlusieursApprosionnement($data)
    {
        $data = GlobaleService::extractLineToData($data);
        for ($i=0; $i<count($data)-1; $i++){
            $id_personnel = Personnel::all()->where('id_utilisateur', Auth::user()->id_utilisateur)->first()->id_personnel;
            self::enregistrerUnApprovisionnement($data[$i][0], $data[$i][1], $id_personnel);
        }
    }

    public static function enregistrerUnApprovisionnement($id_ouvrage, $nombre_exemplaire, $id_personnel){
        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $id_ouvrage)->first();
        $ouvragePhysique->augmenterNombreExemplaire($nombre_exemplaire);
        $ouvragePhysique->save();
        Approvisionnement::create([
            'nombre_exemplaire' => $nombre_exemplaire,
            'date_approvisionnement' => date('d-m-Y'),
            'id_personnel'=>$id_personnel,
            'id_ouvrage_physique'=>$id_ouvrage,
        ]);
    }
}
?>
