<?php

namespace App\Service;

use App\Models\LivresPapier;
use App\Models\OuvragesPhysique;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;


class LivresPapierService
{
    public static function exist(String $ISBN)
    {
        return LivresPapier::all()->where("isbn", $ISBN)->first();
    }

    public static function searchByParamaters($annee_debut, $annee_fin, $langue, $niveau, $type, $dommaine)
    {
        $id_ouvrages = OuvrageService::searchByParamaters($annee_debut, $annee_fin, $langue, $niveau, $type);
        $id_ouvrage_physique = OuvragesPhysiqueService::getIDOuvragePhysiqueByIDOuvrage($id_ouvrages);
        $id_livres_papier = DB::table('livres_papiers')
                            ->whereJsonContains('categorie', [strtolower($dommaine)])
                            ->whereIn('id_livre_papier', $id_ouvrage_physique)
                            ->get();
        //dd(self::id_livre_papier_from_array($id_livres_papier));
        return self::id_livre_papier_from_array($id_livres_papier);
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

}
