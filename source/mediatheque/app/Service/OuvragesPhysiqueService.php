<?php

namespace App\Service;

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
        return [ClassificationDeweyCentaine::all(), ClassificationDeweyDizaine::all()];
    }

    public static function enregisterOuvragePhysique(Request $request, Ouvrage $ouvrage)
    {
        $classificationDizaine = ClassificationDeweyDizaine::all()->where("id_classification_dewey_dizaine", $request["id_classification_dewey_dizaine"])->first();
        $cote = OuvragesPhysiqueService::genererCoteNouvelleOuvrage("livre_papier", $classificationDizaine->classe, [$ouvrage->auteurs()->first()], $ouvrage);

        $ouvragePhysique = OuvragesPhysique::Create([
            'nombre_exemplaire' => $request["nombre_exemplaire"],
            'id_ouvrage'=>$ouvrage->id_ouvrage,
            'cote' => $cote,
            'id_classification_dewey_dizaine'=>$classificationDizaine->id_classification_dewey_dizaine,
        ]);

        return $ouvragePhysique ;
    }

    public static function updateOuvrage(OuvragesPhysique $ouvragePhysique, $nombre_exemplaire){
        $ouvragePhysique->nombre_exemplaire = $nombre_exemplaire;
        $ouvragePhysique->save();
    }

    public static function getIDOuvragePhysiqueByIDOuvrage(array $id_ouvrages)
    {
        $ouvrages_phyqiques = DB::table('ouvrages_physiques')
            ->select('id_ouvrage_physique')
            ->whereIn('id_ouvrage', $id_ouvrages)
            ->get();
        return self::id_ouvrage_physique_from_array($ouvrages_phyqiques);
    }

    public static function id_ouvrage_physique_from_array($ouvrage_physiques)
    {
        $id_ouvrage_physiques = array();
        foreach ($ouvrage_physiques as $op)
        {
            array_push($id_ouvrage_physiques, $op->id_ouvrage_physique);
        }
        return$id_ouvrage_physiques;
    }


    public static function getLivrePapierWithAllAttribute()
    {
        $livresCollection = LivresPapier::all();
        $livresComplet = array();
        foreach ($livresCollection as $lpc)
        {
            if ($lpc->ouvragesPhysique->nombre_exemplaire > 0){
                $livre = array(
                    'id_livre'=>$lpc->id_livre_papier,
                    'titre'=>$lpc->ouvragesPhysique->ouvrage->titre,
                    'ISBN'=>$lpc->ISBN,
                    'cote'=>$lpc->ouvragesPhysique->cote,
                    'nombre_exemplaire'=>$lpc->ouvragesPhysique->nombre_exemplaire,
                );

                array_push($livresComplet, $livre);
            }
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
        $cote .= GlobaleService::formatString($indice_dewey, 3);
        $cote .= strtoupper(substr("CCC", 0, 3)); //utf8_encode($auteurs[0]->nom)
        $cote .= strtolower(substr("O", 0, 1)).GlobaleService::formatString($ouvrage->id_ouvrage, 6); //$ouvrage->titre
        return $cote;
    }

}
