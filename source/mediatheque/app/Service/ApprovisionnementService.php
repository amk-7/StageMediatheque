<?php

namespace App\Service;

use App\Models\Approvisionnement;
use App\Models\DocumentsAudioVisuel;
use App\Models\LivresPapier;
use App\Models\OuvragesPhysique;

class ApprovisionnementService
{
    public static function getOuvrage($type_ouvrage, $ouvrage_code_id)
    {
        if($type_ouvrage=="livre_papier"){
            $ouvrage=LivresPapier::all()->where('ISBN', $ouvrage_code_id)
                ->first();
            return $ouvrage;
        }
        if ($type_ouvrage=="document_audio_visuel"){
            $ouvrage=DocumentsAudioVisuel::all()->where('ISAN', $ouvrage_code_id)
                ->first();
            return  $ouvrage;
        }
    }

    public static function extractLineToData($data)
    {
        $array_data = array();
        $array_data_lines = explode(';', $data);

        for ($i=0; $i<count($array_data_lines); $i++){
            $line_attributes = explode(',', $array_data_lines[$i]);
            array_push($array_data, $line_attributes);
        }
            //dd($array_data);
        return $array_data;
    }

    public static function enregistrerPlusieursApprosionnement($data, $id_personnel)
    {
        $data = self::extractLineToData($data);
        //dd($data);
        for ($i=0; $i<count($data)-1; $i++){
            self::enregistrerUnApprovisionnement($data[$i][0], $data[$i][1], $data[$i][2], $id_personnel);
        }
    }

    public static function enregistrerUnApprovisionnement($id_ouvrage, $type_ouvrage, $nombre_exemplaire, $id_personnel){
        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $id_ouvrage)->first();
        $ouvragePhysique->augmenterNombreExemplaire($nombre_exemplaire);
        $ouvragePhysique->save();
        Approvisionnement::create([
            'nombre_exemplaire' => $nombre_exemplaire,
            'date_approvisionnement' => date('d-m-Y'),
            'id_personnel'=>$id_personnel,
            'type_ouvrage'=>$type_ouvrage,
            'id_ouvrage_physique'=>$id_ouvrage,
        ]);
    }
}

?>
