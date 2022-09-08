<?php

namespace App\Service;

use App\Models\OuvragesElectronique;

class OuvragesElectroniqueService
{
    public static function enregistrerOuvrageELectronique($ouvrage, $url)
    {
        if (! $url == null){
            $chemin_ouvrage = strtolower(str_replace(' ', '_', $ouvrage->titre)).'.'.$url->extension();
            $url->storeAs('public/images/ouvrage_electonique', $chemin_ouvrage);
        } else {
            dd("::::Appeller le developpeur::::");
        }
        $ouvrageElectronique = OuvragesElectronique::create([
            'url' => $chemin_ouvrage,
            'id_ouvrage' => $ouvrage->id_ouvrage,
        ]);
        return $ouvrageElectronique ;
    }
}

?>
