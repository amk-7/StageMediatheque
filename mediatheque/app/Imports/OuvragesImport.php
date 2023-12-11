<?php

namespace App\Imports;

use App\Models\Ouvrage;
use App\Models\TypesOuvrage;
use App\Models\Langue;
use App\Models\Domaine;
use App\Models\Niveau;
use App\Models\Auteur;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\Controller;

class OuvragesImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function supprimerElementsVides($tableau)
    {
        $tableauFiltre = array_filter($tableau, function ($valeur) {
            return $valeur !== "" && $valeur !== null;
        });

        // Réindexer les clés
        return array_values($tableauFiltre);
    }

    public function collection(Collection $rows)
    {
        $numero = 0;
        $indice_auteur = 1;
        $indice_titre = 2;
        $indice_mot_cle = 3;
        $indice_isbn = 4;
        $indice_lieu = 5;
        $indice_annee = 6;
        $indice_nombre_exemplaire = 7;
        $indice_langue = 8;
        $indice_domaine = 9;
        $indice_type = 10;
        $indice_image_path = 11;

        foreach ($rows as $row) {
            if (strtolower($row[$numero])!=="n°"){
                $mots_cle_data = Controller::extractLineToData($row[$indice_mot_cle]);
                $mots_cle = [];
                foreach ($mots_cle_data as $mot_cle_array){
                    array_push($mots_cle, $mot_cle_array[0]);
                }
                // dd($mots_cle);

                $data_auteurs = Controller::extractLineToData($row[$indice_auteur])[0];
                $data_auteurs[0] = explode(' ', trim($data_auteurs[0] ?? ""));
                $data_auteurs[1] = explode(' ', trim($data_auteurs[1] ?? ""));
                $data_auteurs[0] = $this->supprimerElementsVides($data_auteurs[0]);
                $data_auteurs[1] = $this->supprimerElementsVides($data_auteurs[1]);
                //dd($data_auteurs);
                $auteurs = Auteur::enregistrerAuteur($data_auteurs); // Revoir cette fonction

                $row[$indice_titre] = str_replace("'", "-", $row[$indice_titre]);

                //dd(trim(strtolower($row[$indice_type])));
                //dd(TypesOuvrage::where('libelle', trim(strtolower($row[$indice_type])))->get()->first());
                //dump(strtolower($row[$indice_titre]));
                $type =  TypesOuvrage::where('libelle', trim(strtolower($row[$indice_type])))->get()->first();
                if ($type==null){
                    dump($row[$indice_type]);
                }
                $ouvrage = Ouvrage::create([
                    'titre'=>strtolower($row[$indice_titre]),
                    'id_niveau' => Niveau::all()->first()->id_niveau,
                    'id_type'=> $type->id_type_ouvrage ?? null,
                    'image' => $chemin_image ?? "/storage/books/logo.png",
                    'isbn' => $row[$indice_isbn],
                    'resume'=> "",
                    'mot_cle'=>$mots_cle,
                    'annee_apparution'=>$row[$indice_annee],
                    'lieu_edition'=>$row[$indice_lieu],
                    'nombre_exemplaire'=>$row[$indice_nombre_exemplaire],
                    'ressources_externe' => "",
                    'cote' => md5(Ouvrage::all()->count()+1),
                    'documents' => null,
                ]);

                $ouvrage->retirerAuteurs();
                $ouvrage->ajouterAuteurs($auteurs);

                $langues_data = explode(",", $row[$indice_langue]);
                $langues = [];

                foreach ($langues_data as $libelle) {
                    $langue=Langue::all()->where('libelle', trim(strtolower($libelle)))->first();
                    if ($langue){
                        array_push($langues, $langue->id_langue);
                    }
                }
                //dd($langues);
                $ouvrage->retirerLangues();
                $ouvrage->ajouterLangues($langues);

                $domaine_data = explode(",", $row[$indice_domaine]);
                $domaines = [];
                foreach ($domaine_data as $libelle) {
                    $domaine=Domaine::all()->where('libelle', trim(strtolower($libelle)))->first();
                    if ($domaine){
                        array_push($domaines, $domaine->id_domaine);
                    } else {
                        dd($domaine_data);
                    }
                }
                //dd($domaines);
                $ouvrage->retirerDomaines();
                $ouvrage->ajouterDomaines($domaines);

                //dd($ouvrage);
            }
        }
    }
}
