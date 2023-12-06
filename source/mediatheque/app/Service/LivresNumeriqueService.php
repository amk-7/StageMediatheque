<?php

namespace App\Service;

use App\Models\LivresNumerique;
use App\Models\OuvragesElectronique;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Ouvrage;


class LivresNumeriqueService
{
    public static function searchByParamaters($annee_debut, $annee_fin, $langue, $niveau, $type, $domaine, $search)
    {
        $search = strtolower($search);
        $niveau = strtolower($niveau);
        $type = strtolower($type);
        $annee_debut = (int) $annee_debut;
        $annee_fin = (int) $annee_fin;

        // dump($niveau);
        // dump($type);
        // dump($domaine);
        //dd('');

        $ouvrages = Ouvrage::all();
        $id_livres_papier = [];
        foreach ($ouvrages as $ouvrage) {
            $titre = strtolower($ouvrage->titre);
            $mots_cle = implode(";", $ouvrage->mot_cle);
            $ouvrage_annee = (int) $ouvrage->annee_apparution ;
            $ouvrage_niveau = $ouvrage->niveau;
            $ouvrage_type = $ouvrage->type;
            $ouvrage_langue = $ouvrage->langue;
            //dump($titre);
            if ($ouvrage->ouvrageelectronique) {
                // dump($titre);
                // dump($ouvrage_annee);
                $ouvrage_domaine = $ouvrage->ouvrageelectronique->livrenumerique->categorie;
                $ouvrage_domaine = implode(";", $ouvrage_domaine);
                if (
                    (str_contains($titre, $search) || str_contains($mots_cle, $search))
                    && str_contains($ouvrage_langue, $langue)
                    && str_contains($ouvrage_type, $type)
                    && str_contains($ouvrage_niveau, $niveau)
                    && str_contains($ouvrage_domaine, $domaine)
                    && ($ouvrage_annee >= $annee_debut and $ouvrage_annee <= $annee_fin)
                    ){
                    array_push($id_livres_papier, $ouvrage->ouvrageelectronique->livrenumerique->id_livre_numerique);
                }
            }
        }

        return $id_livres_papier;
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
