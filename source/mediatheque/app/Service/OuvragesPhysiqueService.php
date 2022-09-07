<?php

namespace App\Service;

use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaine;
use App\Models\DocumentsAudioVisuel;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OuvragesPhysiqueService
{
    public static function getClassificationsDewey(){
        return [ClassificationDeweyCentaine::all(), ClassificationDeweyDizaine::all()->toJson()];
    }
    public static function enregisterOuvragePhysique(Request $request, Ouvrage $ouvrage)
    {
        $classificationDizaine = ClassificationDeweyDizaine::all()->where("id_classification_dewey_dizaine", $request["id_classification_dewey_dizaine"])->first();

        $ouvragePhysique = OuvragesPhysique::Create([
            'nombre_exemplaire' => $request["nombre_exemplaire"],
            'id_ouvrage'=>$ouvrage->id_ouvrage,
            'id_classification_dewey_dizaine'=>$classificationDizaine->id_classification_dewey_dizaine
        ]);

        return $ouvragePhysique ;
    }

    public static function updateOuvrage(OuvragesPhysique $ouvragePhysique, $nombre_exemplaire){
        $ouvragePhysique->nombre_exemplaire = $nombre_exemplaire;
        $ouvragePhysique->save();
    }

    public static function getIDouvrage($type, $identifiant, $titre)
    {
        if(! empty($identifiant)){
            if($type=='livre_papier'){
                $ouvrage = LivresPapier::all()
                    ->where('ISBN', $identifiant)
                    ->first();
                return $ouvrage!=null ? $ouvrage->id_livre_papier : $ouvrage;
            }
            $ouvrage = DocumentsAudioVisuel::all()
                    ->where('ISAN', $identifiant)
                    ->first();
            return $ouvrage!=null ? $ouvrage->id_document_audio_visuel : $ouvrage;
        }
        if (! empty($titre)){
            $ouvrage = Ouvrage::all()->where('titre', $titre)->first();
            return $ouvrage!=null ? $ouvrage->id_ouvrage : $ouvrage;
        }
    }

    public static function searchOuvrageByTitre($titre){
        $id_ouvrages = DB::table('ouvrages')
                            ->select('id_ouvrage')
                            ->where('titre', 'like', '%'.strtoupper($titre).'%')
                            ->get();
        $liste_id_ouvrages = array();
        foreach ($id_ouvrages as $id_ouvrage){
            array_push($liste_id_ouvrages, $id_ouvrage->id_ouvrage);
        }

        return OuvragesPhysique::all()->whereIn('id_ouvrage_physique', $liste_id_ouvrages);
    }

    public static function getCodeIDTitle(Request $request)
    {
        //return$request;
        $code = $request->code_id;
        if($request->type_code=="livre_papier"){
            $livre = LivresPapier::all()->where('ISBN', $code)->first();
            return $livre != null ? $livre->ouvragePhysique->ouvrage->titre : $livre;
        }
        $doc = DocumentsAudioVisuel::all()->where('ISAN', $code)->first();
        return $doc != null ? $doc->ouvragePhysique->ouvrage->titre : $doc;
    }

    public static function getCodeID(Request $request)
    {
        //return$request;
        //$code = $request->code_id;
        $ouvrage = Ouvrage::all()->where('titre', strtoupper($request->titre));
        if ($ouvrage->count()==1){
            if($request->type_code=='livre_papier'){
                $livre = LivresPapier::all()->whereIn('id_ouvrage_physique', $ouvrage->first()->id_ouvrage);
                if ($livre->count()>0){
                    return $livre->first()->id_livre_papier;
                }
                return null;
            }
            $docAV = DocumentsAudioVisuel::all()->whereIn('id_ouvrage_physique', $ouvrage->first()->id_ouvrage);
            if ($docAV->count()>0){
                return $docAV->first()->id_livre_papier;
            }
            return null;
        }
    }

    public static function getOuvragePhysiqueByType(Request $request)
    {
        if($request->type_code=="livre_papier"){
            $id_livres = self::getArrayKeyFromDBResult(LivresPapier::all(), 'id_ouvrage_physique');
            return json_encode(OuvragesPhysique::all()->whereIn('id_ouvrage', $id_livres));
        }
        $id_docs = self::getArrayKeyFromDBResult(DocumentsAudioVisuel::all(), "id_ouvrage_physique");
        return  json_encode(OuvragesPhysique::all()->whereIn('id_ouvrage', $id_docs));
    }

    public static function getArrayKeyFromDBResult(Collection $collection, $key)
    {
        $array_collection = $collection->toArray();
        $array_key = array();
        foreach ($array_collection as $ouvrage){
            array_push($array_key, $ouvrage[$key]);
        }
        return $array_key;
    }

    public static function getLivrePapierWithAllAttribute()
    {
        $livresCollection = LivresPapier::all();
        $livresComplet = array();
        foreach ($livresCollection as $lpc)
        {
            $livre = array(
                'id_livre'=>$lpc->id_livre_papier,
                'titre'=>$lpc->ouvragePhysique->ouvrage->titre,
                'ISBN'=>$lpc->ISBN,
                'cote'=>$lpc->ouvragePhysique->cote,
                'nombre_exemplaire'=>$lpc->ouvragePhysique->nombre_exemplaire,
            );

            array_push($livresComplet, $livre);
        }

        return $livresComplet;
    }

    public static function getDocAVWithAllAttribute()
    {
        $docsCollection = DocumentsAudioVisuel::all();
        $docsComplet = array();
        foreach ($docsCollection as $dc)
        {
            $doc = array(
                'id_document_audio_visuel'=>$dc->id_document_audio_visuel,
                'titre'=>$dc->ouvragePhysique->ouvrage->titre,
                'ISBN'=>$dc->ISAN,
                'cote'=>$dc->ouvragePhysique->cote,
                'nombre_exemplaire'=>$dc->ouvragePhysique->nombre_exemplaire,
            );

            array_push($docsCollection, $doc);
        }

        return $docsComplet;
    }

    public static function genererCoteNouvelleOuvrage(String $type_livre, $indice_dewey, array $auteurs, Ouvrage $ouvrage)
    {
        //type_livre+indice_dewey+AAA[+AAA]+t+id_ouvrage

        if ($type_livre == 'livre_papier'){
            $type_livre = "LP";
        } elseif ($type_livre == 'document_av'){
            $type_livre = "DA";
        } else {
            return null;
        }

        $cote = $type_livre;
        $cote .= (String) $indice_dewey;
        foreach ($auteurs as $auteur){
            $cote .= strtoupper(substr($auteur->nom, 0, 3));
        }
        $cote .= strtolower(substr($ouvrage->titre, 0, 1)).$ouvrage->id_ouvrage;
        return $cote;
    }
}
