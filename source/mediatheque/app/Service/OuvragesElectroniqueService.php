<?php

namespace App\Service;

use App\Models\OuvragesElectronique;
use Illuminate\Support\Facades\DB;

class OuvragesElectroniqueService
{
    public static function updateOuvrageElectronique($ouvrageElectronique, $url)
    {
        //dd($url);
        $chemin_ouvrage = self::enregistrerPdf($ouvrageElectronique->ouvrage, $url);
        $ouvrageElectronique->url = $chemin_ouvrage;
        $ouvrageElectronique->save();
    }

    public static function enregistrerPdf($ouvrage, $url)
    {
        if (! $url == null)
        {
            $chemin_ouvrage = strtolower(str_replace(' ', '_', $ouvrage->titre)).'.'.$url->extension();
            $url->storeAs('public/images/ouvrage_electonique', $chemin_ouvrage);
            return $chemin_ouvrage;
        } else
        {
            dd("::::Appeller le developpeur::::");
        }
    }

    public static function enregistrerOuvrageELectronique($ouvrage, $url)
    {
        $chemin_ouvrage = enregistrerPdf($ouvrage, $url);
        $ouvrageElectronique = OuvragesElectronique::create([
            'url' => $chemin_ouvrage,
            'id_ouvrage' => $ouvrage->id_ouvrage,
        ]);
        return $ouvrageElectronique ;
    }

    public static function getIDOuvrageElectroniquesByIDOuvrage($id_ouvrages)
    {
        $ouvrages_electonique = DB::table('ouvrages_electroniques')
                                    ->select('id_ouvrage_electronique')
                                    ->whereIn('id_ouvrage', $id_ouvrages)
                                    ->get();

        return self::id_ouvrage_elevtronique_from_array($ouvrages_electonique);
    }

    public static function id_ouvrage_elevtronique_from_array($ouvrage_electronique)
    {
        $id_ouvrage_electroniques = array();
        foreach ($ouvrage_electronique as $oe)
        {
            array_push($id_ouvrage_electroniques, $oe->id_ouvrage_electronique);
        }

        return$id_ouvrage_electroniques;
    }
}

?>
