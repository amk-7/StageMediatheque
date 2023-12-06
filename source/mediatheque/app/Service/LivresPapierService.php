<?php

namespace App\Service;

use App\Models\LivresPapier;
use App\Models\OuvragesPhysique;
use App\Models\Ouvrage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class LivresPapierService
{
    public static function exist(String $ISBN)
    {
        return LivresPapier::all()->where("isbn", $ISBN)->first();
    }

    public static function searchByParamaters($request)
    {
        $annees = OuvrageService::convertAnneeForResearch($request->annee_debut, $request->annee_fin, 1900);
        $search = strtolower($request->search);
        $niveau = strtolower($request->niveau);
        $type = strtolower($request->type);
        $annee_debut = (int) $annees[0];
        $annee_fin = (int) $annees[1];
        $langue = $request->langue;
        $domaine = $request->domaine;

        $ouvrages = LivresPapierService::getLivresPapierWithAllAttributes();
        $id_livres_papier = [];
        $result = [];
        foreach ($ouvrages as $ouvrage) {
            $ouvrage->mot_cle = json_decode($ouvrage->mot_cle, true);

            $titre = strtolower($ouvrage->titre);
            $mots_cle = implode(";", $ouvrage->mot_cle);
            $ouvrage_annee = (int) $ouvrage->annee_apparution;
            $ouvrage_niveau = strtolower($ouvrage->niveau);
            $ouvrage_type = strtolower($ouvrage->type);
            $ouvrage_langue = strtolower($ouvrage->langue);
            $ouvrage_domaine = implode(";", $ouvrage->categorie);

            if (str_contains($titre, $search) || str_contains($mots_cle, $search)) {
                array_push($result, $ouvrage);
            }
        }

        $ouvrages = $result;
        $result = [];

        foreach ($ouvrages as $ouvrage) {

            $titre = strtolower($ouvrage->titre);
            $mots_cle = implode(";", $ouvrage->mot_cle);
            $ouvrage_annee = (int) $ouvrage->annee_apparution;
            $ouvrage_niveau = strtolower($ouvrage->niveau);
            $ouvrage_type = strtolower($ouvrage->type);
            $ouvrage_langue = strtolower($ouvrage->langue);
            $ouvrage_domaine = implode(";", $ouvrage->categorie);

            if ($ouvrage_annee >= $annee_debut && $ouvrage_annee <= $annee_fin) {
                array_push($result, $ouvrage);
            }
        }

        $ouvrages = $result;
        $result = [];

        foreach ($ouvrages as $ouvrage) {

            $titre = strtolower($ouvrage->titre);
            $mots_cle = implode(";", $ouvrage->mot_cle);
            $ouvrage_annee = (int) $ouvrage->annee_apparution;
            $ouvrage_niveau = strtolower($ouvrage->niveau);
            $ouvrage_type = strtolower($ouvrage->type);
            $ouvrage_langue = strtolower($ouvrage->langue);
            $ouvrage_domaine = implode(";", $ouvrage->categorie);

            if (empty($langue) || str_contains($ouvrage_langue, $langue)) {
                array_push($result, $ouvrage);
            }
        }

        $ouvrages = $result;
        $result = [];

        foreach ($ouvrages as $ouvrage) {
            $titre = strtolower($ouvrage->titre);
            $mots_cle = implode(";", $ouvrage->mot_cle);
            $ouvrage_annee = (int) $ouvrage->annee_apparution;
            $ouvrage_niveau = strtolower($ouvrage->niveau);
            $ouvrage_type = strtolower($ouvrage->type);
            $ouvrage_langue = strtolower($ouvrage->langue);
            $ouvrage_domaine = implode(";", $ouvrage->categorie);

            if (empty($niveau) || str_contains($ouvrage_niveau, $niveau)) {
                array_push($result, $ouvrage);
            }
        }

        $ouvrages = $result;
        $result = [];

        foreach ($ouvrages as $ouvrage) {
            //$ouvrage->mot_cle = json_decode($ouvrage->mot_cle, true);

            $titre = strtolower($ouvrage->titre);
            $mots_cle = implode(";", $ouvrage->mot_cle);
            $ouvrage_annee = (int) $ouvrage->annee_apparution;
            $ouvrage_niveau = strtolower($ouvrage->niveau);
            $ouvrage_type = strtolower($ouvrage->type);
            $ouvrage_langue = strtolower($ouvrage->langue);
            $ouvrage_domaine = implode(";", $ouvrage->categorie);

            if (empty($type) || str_contains($ouvrage_type, $type)) {
                array_push($result, $ouvrage);
            }
        }


        $ouvrages = $result;
        $result = [];

        foreach ($ouvrages as $ouvrage) {
            $titre = strtolower($ouvrage->titre);
            $mots_cle = implode(";", $ouvrage->mot_cle);
            $ouvrage_annee = (int) $ouvrage->annee_apparution;
            $ouvrage_niveau = strtolower($ouvrage->niveau);
            $ouvrage_type = strtolower($ouvrage->type);
            $ouvrage_langue = strtolower($ouvrage->langue);
            $ouvrage_domaine = implode(";", $ouvrage->categorie);

            if (empty($domaine) || str_contains($ouvrage_domaine, $domaine)) {
                array_push($result, $ouvrage);
            }
        }

        foreach ($result as $ouvrage) {
            array_push($id_livres_papier, $ouvrage->id_livre_papier);
        }

        return $id_livres_papier;
    }

    public static function searchByTitreMotCleISBN(String $value)
    {
        $id_ouvrages = OuvrageService::searchByTitreMotCle($value);
        $id_ouvrage_phyiques = DB::table('ouvrages_physiques')
                            ->WhereIn('id_ouvrage', $id_ouvrages)
                            ->get();

        $id_livre_papier = DB::table('livres_papiers')
                            ->where('isbn', 'like', $value)
                            ->orWhereIn('id_ouvrage_physique', self::id_ouvrage_physique_from_array($id_ouvrage_phyiques))
                            ->get();

        return self::id_livre_papier_from_array($id_livre_papier);
    }

    public static function searchByMainAttribute(array $id_auteurs, String $categorie, String $ISBN)
    {
        //dd("cool");
        $livre_papier = DB::table('livres_papiers')
            ->select('id_livre_papier')
            ->whereJsonContains('categorie', ["'".$categorie."'"])
            ->orWhere('isbn', $ISBN)
            ->orWhereIn('id_livre_papier', $id_auteurs)
            ->get();
        $id_livre_papier = array();

        foreach ($livre_papier as $lp)
        {
            array_push($id_livre_papier, $lp->id_livre_papier);
        }

        $livresPapierCollection = LivresPapier::all()->whereIn("id_livre_papier", $id_livre_papier);

        return $livresPapierCollection;
    }

   public static function getAllIDLivrePapier($livresPapier){
        $id_livres = [];
        foreach ($livresPapier as $lp){
            array_push($id_livres, $lp->id_livre_papier);
        }
        return $id_livres;
   }

    public static function getAuteurs(Collection $auteursCollection) : array
    {
        $auteurs = array();
        foreach ($auteursCollection as $auteur)
        {
            $nuplet = array(
                "nom"=>$auteur->nom,
                "prenom"=>$auteur->prenom
            );
            array_push($auteurs, $nuplet);
        }
        return $auteurs;
    }

    public static function getCategories(){
        $categories = [
            'français', 'anglais', 'allemand', 'physique', 'education',
            'hydrolique', 'musique et art', 'théologie', 'philosophie', 'zoologie', 'géologie', 'mathématique générale',
            'bibliographie', 'physique', 'médécine', 'comptabilité', 'droit'
        ];
        return $categories;
    }

    public static function id_livre_papier_from_array($livres_papiers)
    {
        $id_lps = array();
        foreach ($livres_papiers as $lp)
        {
            array_push($id_lps, $lp->id_livre_papier);
        }

        return $id_lps;
    }

    public static function id_ouvrage_physique_from_array($ouvrage_physiques)
    {
        $id_op = array();
        foreach ($ouvrage_physiques as $op)
        {
            array_push($id_op, $op->id_ouvrage_physique);
        }

        return $id_op;
    }

    public static function setOuvragesLIstInSession($liste){
        \session(['ouvrages_key' => $liste]);
    }

    public static function getLivresPapierWithAllAttributes()
    {
        return LivresPapier::join('ouvrages_physiques', 'livres_papiers.id_ouvrage_physique', '=', 'ouvrages_physiques.id_ouvrage_physique')
        ->join('ouvrages', 'ouvrages_physiques.id_ouvrage', '=', 'ouvrages.id_ouvrage')
        ->select('livres_papiers.*', 'ouvrages.*', 'ouvrages_physiques.*')
        ->get();

        // $livresPapier = Cache::remember('livres_papier_with_all_attributes', now()->addMinutes(30), function () {
        //     return LivresPapier::join('ouvrages_physiques', 'livres_papiers.id_ouvrage_physique', '=', 'ouvrages_physiques.id_ouvrage_physique')
        //     ->join('ouvrages', 'ouvrages_physiques.id_ouvrage', '=', 'ouvrages.id_ouvrage')
        //     ->select('livres_papiers.*', 'ouvrages.*', 'ouvrages_physiques.*')
        //     ->get();
        // });

        // return $livresPapier;
    }

}
