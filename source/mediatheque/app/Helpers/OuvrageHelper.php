<?php

namespace App\Helpers;

use App\Models\Ouvrage;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class OuvrageHelper
{
    public static function getNiveausTypesLangues(){
        $niveaus = [
            '1er degré', '2è degré', '3è degré', 'université'
        ];

        $types = [
            'roman', 'manuel scolaire', 'document technique', 'document pédagogique', 'bande dessinée', 'journeaux', 'nouvelle'
        ];

        $langues = [
            'français', 'anglais', 'allemend'
        ];
        return [$niveaus, $types, $langues];
    }
    public static function ouvrageExist(String $titre, int $annee_apparution)
    {
        $ouvrage = Ouvrage::all()->where("titre", $titre)->first();
        if ($ouvrage)
        {
            if ($ouvrage->auteurs->first()->pivot->annee_apparution == $annee_apparution)
            {
               return true;
            }
        } return false;
    }

    public static function enregisterOuvrage(Request $request, Array $auteurs)
    {
        $motCle = [];

        if (empty($request["mot_cle_0"])){
            if (is_string($request["mot_cle_0"])){
                $motCle = array([$request["mot_cle_0"]]);
            }else{
                $list_mot_cles = OuvrageHelper::convertDataToArray($request, "motCle");
                $motCle = OuvrageHelper::convertObjetToArray($list_mot_cles, "mot_cle");
            }
        }

        // Récupérer l'image.
        $image = $request->file('image_livre');

        if (! $image==null){
            // Stocker l'image
            $chemin_image = $image->storeAs('public/images/images_livre', $request->titre.'.'.$image->extension());
        } else {
            $image = "default_book_image.png";
        }

        $ouvrage = Ouvrage::create([
            'titre'=>$request["titre"],
            'niveau' => $request["niveau"],
            'type'=>$request["type"],
            'image' => $image,
            'langue'=>$request["langue"],
            'resume'=>$request["resume"],
            'mot_cle'=>$motCle
        ]);

        // Definire les auteurs de l'ouvrage
        foreach ($auteurs as $auteur){
            $ouvrage->auteurs()->attach($auteur->id_auteur, [
                'annee_apparution'=>$request["annee_apparution"],
                'lieu_edition'=>$request["lieu_edition"],
            ]);
        }

        return $ouvrage;
    }

    public static function afficherAuteurs(Ouvrage $ouvrage)
    {
        $resultat = "";
        $auteurs = $ouvrage->auteurs()->get();
       for($i=0; $i<count($auteurs)-1; $i++){
           $resultat .= $auteurs[$i]->nom.",";
       }
        $resultat .= $auteurs[count($auteurs)-1]->nom;

        return $resultat;
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
        echo $list_objet_str;
        $liste_objects = explode(";",$list_objet_str);
        //dd($liste_objects);

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
}
