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


class OuvrageController extends Controller
{
    function welcome(){
        $ouvrages = Ouvrage::all();
        foreach ($ouvrages as $ouvrage) {
            $ouvrage->domaines;
            $ouvrage->domaine = $ouvrage->afficherDomaine;
            $ouvrage->langues;
            $ouvrage->langue = $ouvrage->afficherLangue;
        }

        $annees = 1900;
        $langues = Langue::all();
        $types = TypesOuvrage::all();
        $categories = Domaine::all();
        $niveaus = Niveau::all();

        return view('welcome', compact('ouvrages', 'annees', 'langues', 'types', 'categories', 'niveaus'));
    }

    public function index()
    {
        $ouvrages = Ouvrage::all();
        $annees = 1900;
        $langues = Langue::all();
        $types = TypesOuvrage::all();
        $categories = Domaine::all();;
        $niveaus = Niveau::all();;


        return view('ouvrages2.index', compact('ouvrages', 'annees', 'langues', 'types', 'categories', 'niveaus'));
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

    public function imprimerCote(){
        $ouvrages = Ouvrage::all();
        return view('ouvrages2.imprimerCote', compact('ouvrages'));
    }

    public function create()
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
        //dd($request->all());
        $request->validate([
            'titre'=> 'required|unique:ouvrages',
            'niveau'=>'required|not_in:Sélectionner niveau',
            'type'=>'required|not_in:Sélectionner type',
            'langue'=>'required|not_in:Sélectionner type',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'data_auteurs'=>'required',
            'domaines'=>'required',
            'resume'=>'required',
            'nombre_exemplaire'=>'required',
        ]);

        $mots_cle_data = Controller::extractLineToData($request->data_mots_cle);
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

        //dd($request->all());

        $ouvrage = Ouvrage::create([
            'titre'=>strtolower($request->input("titre")),
            'id_niveau' => $request->input("niveau"),
            'id_type'=> $request->input("type"),
            'image' => $chemin_image,
            'id_langue'=> $request->input("langue"),
            'resume'=> $request->input("resume"),
            'mot_cle'=>$mots_cle,
            'annee_apparution'=>$request->input('annee_apparution'),
            'lieu_edition'=>$request->input('lieu_edition'),
            'nombre_exemplaire'=>$request->input('nombre_exemplaire'),
            'ressources_externe' => $request['ressources_externe'],
            'cote' => md5(Ouvrage::all()->count()+1),
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
        //dd($request->all());
        $request->validate([
            'titre'=> 'required',
            'niveau'=>'required|not_in:Sélectionner niveau',
            'type'=>'required|not_in:Sélectionner type',
            'langues'=>'required|not_in:Sélectionner type',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'data_auteurs'=>'required',
            'domaines'=>'required',
            'resume'=>'required',
            'nombre_exemplaire'=>'required',
        ]);


        $mots_cle_data = Controller::extractLineToData($request->data_mots_cle);
        $mots_cle = [];
        foreach ($mots_cle_data as $mot_cle_array){
            array_push($mots_cle, $mot_cle_array[0]);
        }
        $image = $request->file('image_livre');

        if ($image){
            $chemin_image = $image->storeAs('images/images_livre', "livre_".Ouvrages2::all()->count().'.'.$image->extension());
            $ouvrage->image = $chemin_image;
        } else if( ! $ouvrage->image) {
            $chemin_image = "images/images_livredefault_book_image.png";
            $ouvrage->image = $chemin_image;
        }

        $destination_path = "books/pdf/";
        $chemin_ouvrage_excel = null;
        if ($request->file("document") || $request->document != null)
        {
            $chemin_ouvrage_excel = strtolower($ouvrage->cote).'.'.$request->document->extension();
            $request->document->storeAs("public/".$destination_path, $chemin_ouvrage_excel);
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
        if ($request->file("fileList") || $request->excel != null)
        {
            $chemin_ouvrage_excel = strtolower('ouvrages').'.'.$request->excel->extension();
            $request->excel->storeAs("public/".$destination_path, $chemin_ouvrage_excel);
        } else {
            return redirect()->route('formulaireImportExcelNew');
        }
        //dd($request->all());
        Ouvrage::truncate();
        Excel::import(new OuvragesImport, "storage/$destination_path/$chemin_ouvrage_excel");
        return redirect('/')->with('success', 'All good!');
    }

}
