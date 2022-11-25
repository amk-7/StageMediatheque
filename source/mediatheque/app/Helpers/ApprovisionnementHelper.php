<?php

namespace App\Helpers;

use App\Models\Approvisionnement;
use App\Models\DocumentsAudioVisuel;
use App\Models\LivresPapier;

class ApprovisionnementHelper
{
    public static function afficherIdentifiant(Approvisionnement $approvisionnement)
    {
        //if ($approvisionnement->type_ouvrage == 'livre_papier'){
            $isbn = LivresPapier::all()->where('id_ouvrage_physique', $approvisionnement->id_ouvrage_physique)->first()->ISBN;
            return $isbn;
        /*}
        $isan = DocumentsAudioVisuel::all()->where('id_ouvrage_physique', $approvisionnement->id_ouvrage_physique)->first()->ISBN;
        return $isan;*/
    }

    public static function afficherTypeIdentifiant(Approvisionnement $approvisionnement)
    {
        /*if ($approvisionnement->type_ouvrage == 'livre_papier'){
            return "ISBN";
        }*/ return "ISBN";
    }
}
