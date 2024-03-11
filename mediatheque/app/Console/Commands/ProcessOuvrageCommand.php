<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Http\Controllers\Controller;
use App\Models\Ouvrage;
use App\Models\TypesOuvrage;
use App\Models\Langue;
use App\Models\Domaine;
use App\Models\Niveau;
use App\Models\Auteur;

class ProcessOuvrageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:ouvrage';

    protected $description = 'Import les ouvrages';

    public function handle()
    {

        $file = storage_path("app/public/book_excel_files/ouvrages.xlsx");
        $last_row_index = 0;
        $ouvrages = Ouvrage::all();
        try {
            $this->info("Importing data from $file...");
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            foreach ($data as $i => $row) {
                $i++;
                if ($i > $last_row_index) {
                    $this->info("Insert row $i");
                    if ($row) {
                        $this->processRow($row,  $ouvrages);
                    }
                }
            }
            $this->info('Import completed successfully.');
        } catch (\Exception $e) {
            $this->error('Error during import: ' . $e->getMessage());
        }

        $this->comment("Success");
    }

    public function processRow($row,  $ouvrages)
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

        if (strtolower($row[$numero])!=="n°"){
            $titre = strtolower($row[$indice_titre]);
            $annee_apparution = $row[$indice_annee];
            $ouvrage =  $ouvrages->where('titre', $titre)->where('annee_apparution', $annee_apparution)->first();

            if ($ouvrage || $titre == "") {
                // dump($ouvrage->titre);
                return;
            }

            $mots_cle_data = Controller::extractLineToData($row[$indice_mot_cle]);
            $mots_cle = [];
            foreach ($mots_cle_data as $mot_cle_array){
                array_push($mots_cle, $mot_cle_array[0]);
            }

            $data_auteurs = Controller::extractLineToData($row[$indice_auteur])[0];
            $data_auteurs[0] = explode(' ', trim($data_auteurs[0] ?? ""));
            $data_auteurs[1] = explode(' ', trim($data_auteurs[1] ?? ""));
            $data_auteurs[0] = $this->supprimerElementsVides($data_auteurs[0]);
            $data_auteurs[1] = $this->supprimerElementsVides($data_auteurs[1]);
            $auteurs = Auteur::enregistrerAuteur($data_auteurs); // Revoir cette fonction

            $row[$indice_titre] = str_replace("'", "-", $row[$indice_titre]);

            $type = TypesOuvrage::where('libelle', trim(strtolower($row[$indice_type])))->first();

            if ($type==null){
                dump($row[$indice_type]);
            }

            $ouvrage = Ouvrage::create([
                'titre'=>$titre,
                'id_niveau' => Niveau::all()->first()->id_niveau,
                'id_type'=> $type->id_type_ouvrage ?? null,
                'image' => $chemin_image ?? "/storage/books/logo.png",
                'isbn' => $row[$indice_isbn],
                'resume'=> "",
                'mot_cle'=>$mots_cle,
                'annee_apparution'=>$annee_apparution,
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
                if (! empty($libelle)) {
                    $langue=Langue::where('libelle', trim(strtolower($libelle)))->first();
                    if ($langue){
                        array_push($langues, $langue->id_langue);
                    }
                }
            }
            $ouvrage->retirerLangues();
            $ouvrage->ajouterLangues($langues);

            $domaine_data = explode(";", $row[$indice_domaine]);
            $domaines = [];
            foreach ($domaine_data as $libelle) {
                $domaine=Domaine::where('libelle', trim(strtolower($libelle)))->first();
                if ($domaine){
                    array_push($domaines, $domaine->id_domaine);
                } else {
                    //dump($libelle);
                }
            }

            $ouvrage->retirerDomaines();
            $ouvrage->ajouterDomaines($domaines);
        }
    }

    public function supprimerElementsVides($tableau)
    {
        $tableauFiltre = array_filter($tableau, function ($valeur) {
            return $valeur !== "" && $valeur !== null;
        });

        // Réindexer les clés
        return array_values($tableauFiltre);
    }
}
