<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AbonneImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $abonne_data) {
            $nom = $abonne_data[1];
            $prenom = $abonne_data[2];
            $username = $abonne_data[3];
            $email = $abonne_data[4];
            $contact = $abonne_data[5];
            $ville = $abonne_data[6];
            $quartier = $abonne_data[7];
            $numéro_maison = $abonne_data[8];
            $profession = $abonne_data[9];
            $cntact_a_prevenir = $abonne_data[10];
            //$type_carte = $abonne_data[10]->type_de_carte == "1" ? "Identité" : "Scolaire",
            $numero_carte = $abonne_data[11];
            $a_payer = $abonne_data[12]=="Oui" ? true : false;
            
            dump($abonne_data);
        }
        //dump($collection);
    }

    
}
