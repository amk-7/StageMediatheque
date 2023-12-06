<?php

namespace App\Service;

use App\Models\Auteur;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Models\OuvragesElectronique;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class OuvrageService
{
    public static function supprimer_ouvrage($id_ouvrage)
    {
        $ouvrage = Ouvrage::all()->where('id_ouvrage', $id_ouvrage)->first();
        $ouvrage->auteurs()->detach();
        $ouvrage->delete();
    }

    public static function searchByTitreMotCle(String $value)
    {
        $id_ouvrages = DB::table('ouvrages')
            ->select('id_ouvrage')
            ->whereJsonContains('mot_cle', [strtolower($value)])
            ->orWhere('titre', 'like', '%'.strtoupper($value).'%')
            ->get();

        return self::id_ouvrage_from_array($id_ouvrages);
    }

    public static function id_ouvrage_from_array($ouvrages)
    {
        $id_ouvrages = array();
        foreach ($ouvrages as $o)
        {
            array_push($id_ouvrages, $o->id_ouvrage);
        }

        return$id_ouvrages;
    }

    public static function searchByParamaters($annee_debut, $annee_fin, $langue, $niveau, $type)
    {
        $id_ouvrages = DB::table('ouvrages')
            ->select("id_ouvrage")
            ->where('langue', 'like', '%'.$langue.'%')
            ->where('niveau', 'like', '%'.$niveau.'%')
            ->where('type', 'like', '%'.$type.'%')
            ->whereBetween('annee_apparution', [$annee_debut, $annee_fin])
            ->get();
        return self::id_ouvrage_from_array($id_ouvrages);
    }

    public static function updateOuvrage(Request $request, Ouvrage $ouvrage)
    {
        $mots_cle_data = GlobaleService::extractLineToData($request->data_mots_cle);
        $mots_cle = [];
        foreach ($mots_cle_data as $mot_cle_array){
            array_push($mots_cle, $mot_cle_array[0]);
        }
        $image = $request->file('image_livre');

        if ($image){
            $chemin_image = $image->storeAs('images/images_livre', "livre_".Ouvrage::all()->count().'.'.$image->extension());
            // $chemin_image = "/storage/images/images_livre/".str_replace(" ", "_", $request->titre).'.'.$image->extension();
        } else {
            $chemin_image = "images/images_livredefault_book_image.png";
        }
        $ouvrage['titre'] = strtoupper($request["titre"]);
        $ouvrage['niveau'] = strtolower($request["niveau"]);
        $ouvrage['type'] = strtolower($request["type"]);
        $ouvrage['image'] = $chemin_image;
        $ouvrage['langue'] = strtolower($request["langue"]);
        $ouvrage['resume'] = ucfirst($request["resume"]);
        $ouvrage['mot_cle'] = $mots_cle;
        $ouvrage['annee_apparution'] = $request["annee_apparution"];
        $ouvrage['ressources_externe'] = $request["ressources_externe"];
        $ouvrage->save();

        $ouvrage->auteurs()->detach();
        $data_auteurs = GlobaleService::extractLineToData($request->data_auteurs);
        $auteurs = AuteurService::enregistrerAuteur($data_auteurs);
        self::definireAuteur($ouvrage, $auteurs);
    }

    public static function getNiveausTypesLanguesAuteursAnnee(){
        $niveaus = [
            '1', '2', '3', 'université'
        ];

        $types = [
            'roman', 'manuel scolaire', 'document technique', 'document pédagogique', 'bande dessinée', 'journeaux', 'nouvelle'
        ];

        $langues = [
            'français', 'anglais', 'allemand'
        ];

        return [$niveaus, $types, $langues, Auteur::all(), 1900];
    }

    public static function enregisterOuvrage(Request $request, Array $auteurs)
    {
        $mots_cle_data = GlobaleService::extractLineToData($request->data_mots_cle);
        $mots_cle = [];
        foreach ($mots_cle_data as $mot_cle_array){
            array_push($mots_cle, $mot_cle_array[0]);
        }
        $image = $request->file('image_livre');

        if (! $image==null){
            $chemin_image = "livre_".Ouvrage::all()->count().'.'.$image->extension();
            $image->storeAs('images/images_livre', $chemin_image);
        } else {
            $chemin_image = "images/images_livre/default_book_image.png";
        }

        $ouvrage = Ouvrage::create([
            'titre'=>strtolower($request["titre"]),
            'niveau' => strtolower($request["niveau"]),
            'type'=>strtolower($request["type"]),
            'image' => $chemin_image,
            'langue'=>strtolower($request["langue"]),
            'resume'=>strtolower($request["resume"]),
            'mot_cle'=>$mots_cle,
            'annee_apparution'=>$request["annee_apparution"],
            'lieu_edition'=>$request["lieu_edition"],
            'ressources_externe' => $request['ressources_externe'],
        ]);

        // Definire les auteurs de l'ouvrage
        self::definireAuteur($ouvrage, $auteurs);
        return $ouvrage;
    }

    public static function definireAuteur($ouvrage, $auteurs)
    {
        // Definire les auteurs de l'ouvrage
        foreach ($auteurs as $auteur){
            $ouvrage->auteurs()->attach($auteur->id_auteur);
        }
    }

    public static function convertDataToArray(Request $request, String $object)
    {
        $list_objet_str = "";

        $continuer = true;
        $id = 0;
        while($continuer){
            if(! empty($request["$object$id"])){
                $list_objet_str .= $request["$object$id"].";";
                $id++;
            } else {
                $continuer = false;
            }
        }
        $liste_objects = explode(";",strtolower($list_objet_str.";"));

        return $liste_objects;
    }

    public static function convertObjetToArray(Array $objects, String $object)
    {
        $objectsJson = array();
        for($i=0; $i<count($objects)-1; $i++){
            $objectsJson["$object$i"] = $objects[$i];
        }
        return $objectsJson;
    }

    public static function convertAnneeForResearch($debut, $fin, String $default_debut)
    {
        if (empty($debut)){
            $debut = (int) $default_debut;
        }
        if (empty($fin)){
            $fin = (int) date('Y');
        }

        if (! empty($debut) and ! empty($fin)){
            $debut = (int) $debut;
            $fin = (int) $fin;
            if ($debut > $fin){
                $value = $fin ;
                $fin = $debut ;
                $debut = $value ;
            }
        }

        return array($debut, $fin);
    }

    public static function ouvrageExist($titre, $annee, $lieu_edition)
    {
        $titre = str_replace(" ", "", trim(strtolower($titre) ?? ""));
        $ouvrages = session('ouvrages');
        if (! $ouvrages){
            $ouvrages = Ouvrage::all();
        }
        foreach($ouvrages as $ouvrage){
            if (str_replace(" ", "", trim(strtolower($ouvrage['titre']) ?? ""))==$titre && $ouvrage['annee']== $annee){
                return Ouvrage::all()->where('id_ouvrage', $ouvrage['id'])->first();
            }
        }
        return null;
    }

    public static function ouvragePhysiqueExist($ouvrage)
    {
        return OuvragesPhysique::all()->where("id_ouvrage", $ouvrage->id_ouvrage)->first();
    }

    public static function ouvrageNumeriqeExist($ouvrage)
    {
        return OuvragesElectronique::all()->where("id_ouvrage", $ouvrage->id_ouvrage)->first();
    }


    public static function getNombreExamplaireAndOuvrage()
    {
        $nombre_ouvrage = LivresPapier::all()->count();
        $ouvrage = LivresPapier::all();
        $nombre_examplaire = 0;
        foreach ($ouvrage as $lp){
            $nombre_examplaire += $lp->ouvragesPhysique->nombre_exemplaire;
        }

        return array($nombre_ouvrage, $nombre_examplaire);
    }


}
