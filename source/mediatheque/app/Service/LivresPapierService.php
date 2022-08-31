<?php

namespace App\Service;

use App\Models\LivresPapier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;

class LivresPapierService
{
    public static function exist(String $ISBN) : Boolean
    {
        return LivresPapier::all()->where("ISBN", $ISBN)->first();
    }

    public static function searchByTitre(String $titre)
    {
        return self::getAll()->filter(function ($livre) use ($titre) {
            return Str::contains(strtolower($livre["titre"]), strtolower($titre));
        });
    }

    public static function searchByMainAttribute(array $id_auteurs, String $categorie, String $ISBN)
    {
        $livre_papier = DB::table('livres_papiers')
            ->select('id_livre_papier')
            ->whereJsonContains('categorie', ["'".$categorie."'"])
            ->orWhere('ISBN', $ISBN)
            ->orWhereIn('id_livre_papier', $id_auteurs)
            ->get();
        $id_livre_papier = array();

        foreach ($livre_papier as $lp)
        {
            array_push($id_livre_papier, $lp->id_ouvrage);
        }

        $livresPapierCollection = LivresPapier::all()->whereIn("id_livre_papier", $id_livre_papier);
        dd($livresPapierCollection);

        return $livresPapierCollection;
    }

    public static function getAll()
    {
        //if ($livresPapierCollection == null)
        $livresPapierCollection = LivresPapier::all();
        $livresPapier = array();
        foreach ($livresPapierCollection as $livrePapier)
        {
            $nuplet = array(
                'id_livre_papier'=>$livrePapier->id_livre_papier,
                'titre'=>$livrePapier->ouvragePhysique->ouvrage->titre,
                'niveau'=>$livrePapier->ouvragePhysique->ouvrage->niveau,
                'type'=>$livrePapier->ouvragePhysique->ouvrage->type,
                'langue'=>$livrePapier->ouvragePhysique->ouvrage->langue,
                'image'=>$livrePapier->ouvragePhysique->ouvrage->image,
                'mot_cle'=>$livrePapier->ouvragePhysique->ouvrage->mot_cle,
                'nombre_exemplaire'=>$livrePapier->ouvragePhysique->nombre_exemplaire,
                'disponibilite'=>$livrePapier->ouvragePhysique->disponibilite,
                'annee_apparution'=>$livrePapier->ouvragePhysique->ouvrage->auteurs()->first()->pivot->annee_apparution,
                'lieu_edition'=>$livrePapier->ouvragePhysique->ouvrage->auteurs()->first()->pivot->lieu_edition,
                'auteurs'=>LivresPapierService::getAuteurs($livrePapier->ouvragePhysique->ouvrage->auteurs),
                'etagere'=>$livrePapier->ouvragePhysique->classificationDeweyDizaine->matiere,
                'rayon'=>$livrePapier->ouvragePhysique->classificationDeweyDizaine->classificationDeweyCentaine->theme,
                'ISBN'=>$livrePapier->ISBN,
                'categorie'=>$livrePapier->categorie,
                'nombre_pret'=>null,
                "nombre_reservation"=>null,
                "instance"=>$livrePapier
            );
            array_push($livresPapier, $nuplet);
        }
        return collect($livresPapier);
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

    public static function echapCote(String $string)
    {
        $indiceCote = 0;
        $newString = "";
        if ($string[0]=="'"){
            $newString = "\\";
        }

        /*for($i=0; $i<count($string); $i++){
            $newString .= $string[$i];
            if($string[$i+1]=="'"){
                $newString .= "\\";
            }
        }*/

    }
}
