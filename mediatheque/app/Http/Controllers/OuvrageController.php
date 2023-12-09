<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LivresPapier;
use App\Models\LivresNumerique;
use App\Service\LivresPapierService;
use App\Service\OuvrageService;
use App\Service\GlobaleService;
use App\Service\AuteurService;

use App\Models\Ouvrage;
use App\Models\TypesOuvrage;
use App\Models\Langue;
use App\Models\Domaine;
use App\Models\Nature;
use App\Models\Niveau;

use Illuminate\Support\Facades\Validator;


class OuvrageController extends Controller
{
    function welcome(Request $request){
        $ouvrages = Ouvrage::paginate(4);
        $annees = [];
        $langues = [];
        $types = [];
        $categories = [];
        $niveaus = [];

        return view('welcome', compact('ouvrages', 'annees', 'langues', 'types', 'categories', 'niveaus'));
    }

    public function index(Request $request)
    {
        $ouvrages = Ouvrage::when($request->has('titre'), function ($query) use ($request) {
            return $query->where('titre', 'like', '%' . $request->input('titre') . '%');
        })
        ->when($request->has('type'), function ($query) use ($request) {
            $typeId = TypesOuvrage::where('libelle', $request->input('type'))->value('id_type_ouvrage');
            return $query->where('id_type', $typeId);
        })
        ->when($request->has('langue'), function ($query) use ($request) {
            $langueId = Langue::where('libelle', $request->input('langue'))->value('id_langue');
            return $query->where('id_langue', $langueId);
        })
        // ->when($request->has('domaine'), function ($query) use ($request) {
        //     return $query->where('id_domaine', $request->input('domaine'));
        // })
        ->when($request->has('nature'), function ($query) use ($request) {
            $natureId = Nature::where('libelle', $request->input('nature'))->value('id_nature');
            return $query->where('id_nature', $natureId);
        })
        ->when($request->has('niveau'), function ($query) use ($request) {
            $niveauId = Niveau::where('libelle', $request->input('niveau'))->value('id_niveau');
            return $query->where('id_niveau', $niveauId);
        })
        ->get();

        $ouvrages = Ouvrage::paginate(100);

        $annees = [];
        $langues = [];
        $types = [];
        $categories = [];
        $niveaus = [];


        return view('ouvrages2.index', compact('ouvrages', 'annees', 'langues', 'types', 'categories', 'niveaus'));
    }

    public function create()
    {
        $types = TypesOuvrage::all();
        $langues = Langue::all();
        $domaines = Domaine::all();
        $natures = Nature::all();
        $niveaux = Niveau::all();

        return view('ouvrages2.create', compact('types', 'langues', 'domaines', 'natures', 'niveaux'));
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

    public function edit(Ouvrage $ouvrage)
    {
        $types = TypesOuvrage::all();
        $langues = Langue::all();
        $domaines = Domaine::all();
        $natures = Nature::all();
        $niveaux = Niveau::all();
        //dd($ouvrage);
        return view('ouvrages2.create', compact('ouvrage', 'types', 'langues', 'domaines', 'natures', 'niveaux'));
    }

    public function update(Request $request, Ouvrage $ouvrage)
    {
        //dd($request->all());
        $request->validate([
            'titre'=> 'required',
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

        if ($image){
            $chemin_image = $image->storeAs('images/images_livre', "livre_".Ouvrages2::all()->count().'.'.$image->extension());
            $ouvrage->image = $chemin_image;
        } else if( ! $ouvrage->image) {
            $chemin_image = "images/images_livredefault_book_image.png";
            $ouvrage->image = $chemin_image;
        }

        $ouvrage->titre = strtolower($request->input("titre"));
        $ouvrage->id_niveau = $request->input("niveau");
        $ouvrage->id_type = $request->input("type");
        $ouvrage->id_langue = $request->input("langue");
        $ouvrage->resume = $request->input("resume");
        $ouvrage->mot_cle = $mots_cle;
        $ouvrage->annee_apparution = $request->input("annee_apparution");
        $ouvrage->lieu_edition = $request->input("lieu_edition");
        $ouvrage->ressources_externe = $request->input("ressources_externe");
        $ouvrage->save();

        $ouvrage->retirerDomaines($request->domaines);
        $ouvrage->ajouterDomaines($request->domaines);
        //dd($ouvrage->domaines);
        // $ouvrage->auteurs()->detach();
        // $data_auteurs = GlobaleService::extractLineToData($request->data_auteurs);
        // $auteurs = AuteurService::enregistrerAuteur($data_auteurs);
        // self::definireAuteur($ouvrage, $auteurs);

        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage mis à jour avec succès.');
    }

    public function destroy(Ouvrage $ouvrage)
    {
        $ouvrage->delete();
        return redirect()->route('ouvrages.index')->with('success', 'Ouvrage supprimé avec succès.');
    }

    public static function definireAuteur($ouvrage, $auteurs)
    {
        // Definire les auteurs de l'ouvrage
        foreach ($auteurs as $auteur){
            $ouvrage->auteurs()->attach($auteur->id_auteur);
        }
    }
}
