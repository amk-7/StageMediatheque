<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ouvrage;
use App\Models\TypesOuvrage;
use App\Models\Langue;
use App\Models\Domaine;
use App\Models\Niveau;
use App\Models\Auteur;

use App\Imports\OuvragesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;


class OuvrageController extends Controller
{
    function welcome(Request $request)
    {

        $selected_search = $request->input('search');
        $selected_min = $request->input('min');
        $selected_max = $request->input('max');
        $selected_langue = $request->input('langue');
        $selected_type = $request->input('type');
        $selected_domaine = $request->input('domaine');
        $selected_niveau = $request->input('niveau');

        $filters = [
            'search' => $selected_search,
            'min' => $selected_min,
            'max' => $selected_max,
            'langue' => $selected_langue,
            'type' => $selected_type,
            'domaine' => $selected_domaine,
            'niveau' => $selected_niveau,
        ];

        $ouvrages = Ouvrage::filter($filters)->orderBy('titre', 'asc')->get();

        $annees = 1900;
        $langues = Langue::all();
        $types = TypesOuvrage::all();
        $categories = Domaine::all();
        $niveaus = Niveau::all();

        return view('welcome')->with([
            'ouvrages' => $ouvrages,
            'annees' => $annees,
            'langues' => $langues,
            'types' => $types,
            'categories' => $categories,
            'niveaus' => $niveaus,
            'selected_search' => $selected_search,
            'selected_min' => $selected_min,
            'selected_max' => $selected_max,
            'selected_langue' => $selected_langue,
            'selected_type' => $selected_type,
            'selected_domaine' => $selected_domaine,
            'selected_niveau' => $selected_niveau,
        ]);
    }

    public function index(Request $request)
    {
        $annees = 1900;
        $langues = Langue::all();
        $types = TypesOuvrage::all();
        $categories = Domaine::all();
        $niveaus = Niveau::all();

        $selected_search = $request->input('search');
        $selected_min = $request->input('min');
        $selected_max = $request->input('max');
        $selected_langue = $request->input('langue');
        $selected_type = $request->input('type');
        $selected_domaine = $request->input('domaine');
        $selected_niveau = $request->input('niveau');

        $filters = [
            'search' => $selected_search,
            'min' => $selected_min,
            'max' => $selected_max,
            'langue' => $selected_langue,
            'type' => $selected_type,
            'domaine' => $selected_domaine,
            'niveau' => $selected_niveau,
        ];
        $ouvrages = Ouvrage::filter($filters)->orderBy('annee_apparution', 'asc')->paginate(20);
        $nb_ouvrage = Ouvrage::count();
        return view('ouvrages2.index')->with([
            'ouvrages' => $ouvrages,
            'nb_ouvrage' => $nb_ouvrage,
            'annees' => $annees,
            'langues' => $langues,
            'types' => $types,
            'categories' => $categories,
            'niveaus' => $niveaus,
            'selected_search' => $selected_search,
            'selected_min' => $selected_min,
            'selected_max' => $selected_max,
            'selected_langue' => $selected_langue,
            'selected_type' => $selected_type,
            'selected_domaine' => $selected_domaine,
            'selected_niveau' => $selected_niveau,
        ]);
    }

    public function indexArchive()
    {
        $ouvrages = Ouvrage::withTrashed()->get();
        $annees = 1900;
        $langues = Langue::all();
        $types = TypesOuvrage::all();
        $categories = Domaine::all();
        $niveaus = Niveau::all();

        return view('archives.archivesAbonne', compact('ouvrages', 'annees', 'langues', 'types', 'categories', 'niveaus'));
    }

    public function imprimerCote()
    {
        $ouvrages = Ouvrage::all();
        return view('ouvrages2.imprimerCote', compact('ouvrages'));
    }

    public function create(Request $request)
    {
        $types = TypesOuvrage::all();
        $langues = Langue::all();
        $domaines = Domaine::all();
        $niveaux = Niveau::all();
        $auteurs = Auteur::all();

        return view('ouvrages2.create', compact('types', 'langues', 'domaines', 'niveaux', 'auteurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|unique:ouvrages',
            'niveau' => 'required|not_in:Sélectionner niveau',
            'type' => 'required|not_in:Sélectionner type',
            'langues' => 'required',
            'annee_apparution' => 'required',
            'lieu_edition' => 'required',
            'data_auteurs' => 'required',
            'domaines' => 'required',
            'resume' => 'required',
            'nombre_exemplaire' => 'numeric|min:1',
        ]);

        $mots_cle_data = Controller::extractLineToData($request->data_mots_cle);
        $mots_cle = [];
        foreach ($mots_cle_data as $mot_cle_array) {
            if (! empty($mot_cle_array[0])){
                array_push($mots_cle, $mot_cle_array[0]);
            }
        }

        $image = $request->file('image_livre');

        if (!$image == null) {
            $id = Ouvrage::all()->count()+1;
            $chemin_image = "images/images_livre/livre_" . $id . '.' . $image->extension();
            $image->storeAs('public/', $chemin_image);
        } else {
            $chemin_image = "/storage/books/logo.png";
        }

        //dd($request->all());

        $ouvrage = Ouvrage::create([
            'titre' => strtolower($request->input("titre")),
            'id_niveau' => $request->input("niveau"),
            'id_type' => $request->input("type"),
            'image' => $chemin_image,
            'id_langue' => $request->input("langue"),
            'resume' => $request->input("resume"),
            'mot_cle' => $mots_cle,
            'annee_apparution' => $request->input('annee_apparution'),
            'lieu_edition' => $request->input('lieu_edition'),
            'nombre_exemplaire' => $request->input('nombre_exemplaire'),
            'ressources_externe' => $request['ressources_externe'],
            'cote' => md5(Ouvrage::all()->count() + 1),
        ]);

        // $data_auteurs = GlobaleService::extractLineToData($request->data_auteurs);
        // $auteurs = AuteurService::enregistrerAuteur($data_auteurs);
        // self::definireAuteur($ouvrage, $auteurs);

        $ouvrage->ajouterDomaines($request->domaines);

        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage créé avec succès.');
    }

    public function show(Ouvrage $ouvrage)
    {
        return view('ouvrages2.show', compact('ouvrage'));
    }

    public function readPdf(Ouvrage $ouvrage)
    {
        return view('ouvrages2.lire', compact('ouvrage'));
    }

    public function edit(Ouvrage $ouvrage)
    {
        $types = TypesOuvrage::all();
        $langues = Langue::all();
        $domaines = Domaine::all();
        $niveaux = Niveau::all();
        $auteurs = Auteur::all();

        return view('ouvrages2.create', compact('ouvrage', 'types', 'langues', 'domaines', 'niveaux', 'auteurs'));
    }

    public function update(Request $request, Ouvrage $ouvrage)
    {
        $request->validate([
            'titre' => 'required',
            'niveau' => 'required|not_in:Sélectionner niveau',
            'type' => 'required|not_in:Sélectionner type',
            'langues' => 'required|not_in:Sélectionner type',
            'annee_apparution' => 'required',
            'lieu_edition' => 'required',
            'data_auteurs' => 'required',
            'domaines' => 'required',
            'resume' => 'required',
        ]);


        $mots_cle_data = Controller::extractLineToData($request->data_mots_cle);
        $mots_cle = [];
        foreach ($mots_cle_data as $mot_cle_array) {
            array_push($mots_cle, $mot_cle_array[0]);
        }
        $image = $request->file('image_livre');

        if ($image) {
            $id = $ouvrage->id_ouvrage ;
            $chemin_image = "/images/images_livre/livre" . $id . '.' . $image->extension();
            $image->storeAs('public/', $chemin_image);
            $ouvrage->image = "/storage$chemin_image";
        }



        $destination_path = "books/pdf/";
        $chemin_ouvrage_excel = null;
        if ($request->file("document") || $request->document != null) {
            try {
                $chemin_ouvrage_excel = strtolower($ouvrage->cote) . '.' . $request->document->extension();
                $request->document->storeAs("public/" . $destination_path, $chemin_ouvrage_excel);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        $ouvrage->titre = strtolower($request->input("titre"));
        $ouvrage->id_niveau = $request->input("niveau");
        $ouvrage->id_type = $request->input("type");
        $ouvrage->documents =  $ouvrage->documents ?? $chemin_ouvrage_excel;
        $ouvrage->resume = $request->input("resume");
        $ouvrage->mot_cle = $mots_cle;
        $ouvrage->annee_apparution = $request->input("annee_apparution");
        $ouvrage->lieu_edition = $request->input("lieu_edition");
        $ouvrage->ressources_externe = $request->input("ressources_externe");

        $ouvrage->save();

        $ouvrage->retirerLangues($request->langues);
        $ouvrage->ajouterLangues($request->langues);

        $ouvrage->retirerDomaines($request->domaines);
        $ouvrage->ajouterDomaines($request->domaines);

        $data_auteurs = Controller::extractLineToData($request->data_auteurs);
        $auteurs = Auteur::enregistrerAuteur($data_auteurs);
        $ouvrage->retirerAuteurs();
        $ouvrage->ajouterAuteurs($auteurs);
        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage mis à jour avec succès.');
    }

    public function destroy(Ouvrage $ouvrage)
    {
        $ouvrage->delete();
        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage supprimé avec succès.');
    }

    public function uploadLivresPapierView()
    {
        return view('ouvrages2.excel_import');
    }

    public function import(Request $request)
    {
        $destination_path = "book_excel_files/";

        try {
            $chemin_ouvrage_excel = strtolower('ouvrages') . '.' . $request->excel->extension();
            $request->excel->storeAs("public/" . $destination_path, $chemin_ouvrage_excel);
            Artisan::call("process:ouvrage");
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect('/ouvrages')->with('success', 'Importation réussie !');
    }
}
