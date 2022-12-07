<?php

namespace App\Service;

use App\Models\LivresNumerique;
use App\Models\OuvragesElectronique;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LivresNumeriqueService
{
    public static function searchByParamaters($annee_debut, $annee_fin, $langue, $niveau, $type, $dommaine)
    {
        $id_ouvrages = OuvrageService::searchByParamaters($annee_debut, $annee_fin, $langue, $niveau, $type);
        $id_ouvrage_electroniques = OuvragesElectroniqueService::getIDOuvrageElectroniquesByIDOuvrage($id_ouvrages);
        $id_livres_numerique = DB::table('livres_numeriques')
            ->whereJsonContains('categorie', [strtolower($dommaine != null ? $dommaine : "")])
            ->whereIn('id_livre_numerique', $id_ouvrage_electroniques)
            ->get();
        //dd($id_livres_numerique);
        return self::id_livre_numerique_from_array($id_livres_numerique);
    }

    public static function searchByTitreMotCleISBN(String $value)
    {
        $id_ouvrages = OuvrageService::searchByTitreMotCle($value);
        $id_ouvrage_electroniques = OuvragesElectroniqueService::getIDOuvrageElectroniquesByIDOuvrage($id_ouvrages);
        $id_livre_numerique = DB::table('livres_numeriques')
            ->where('ISBN', 'like', $value)
            ->orWhereIn('id_livre_numerique', $id_ouvrage_electroniques)
            ->get();
        return self::id_livre_numerique_from_array($id_livre_numerique);
    }

    public static function getAllIDLivreNumerique(Collection $livresNumerique)
    {
        $id = [];
        foreach ($livresNumerique as $ln)
        {
            array_push($id, $ln->id_livre_numerique);
        }
        return $id;
    }

    public static function id_livre_numerique_from_array($livres_numeriques)
    {
        $id_ln =[];
        foreach ($livres_numeriques as $lp)
        {
            array_push($id_ln, $lp->id_livre_numerique);
        }

        return$id_ln;
    }
}
?>
