<?php

namespace App\Http\Controllers;

use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Service\AuteurServices;
use App\Service\LivresPapierService;
use App\Service\OuvrageService;
use App\Service\OuvragesPhysiqueService;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;

class LivresPapierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        /*$annee = Carbon::now();
        dd($annee);*/
        $niveausTypesLanguesAuteurs = OuvrageService::getNiveausTypesLanguesAuteurs();
        $categories = LivresPapierService::getCategories();
        $livresPapiers = LivresPapierService::getAll();

        return view('livresPapier.index')->with([
            'niveaus'=> $niveausTypesLanguesAuteurs[0],
            'types'=>$niveausTypesLanguesAuteurs[1],
            'langues'=>$niveausTypesLanguesAuteurs[2],
            'auteurs'=>$niveausTypesLanguesAuteurs[3],
            'categories'=>$categories,
            'livresPapiers'=>$livresPapiers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        $niveausTypesLanguesAuteurs = OuvrageService::getNiveausTypesLanguesAuteurs();
        $categories = LivresPapierService::getCategories();
        $classifications_dewey = OuvragesPhysiqueService::getClassificationsDewey();

        return view('livresPapier.create')->with([
            'niveaus'=> $niveausTypesLanguesAuteurs[0],
            'types'=>$niveausTypesLanguesAuteurs[1],
            'langues'=>$niveausTypesLanguesAuteurs[2],
            'auteurs'=>$niveausTypesLanguesAuteurs[3],
            'categories'=>$categories,
            'classification_dewey_centaines'=>$classifications_dewey[0],
            'classification_dewey_dizaines'=>$classifications_dewey[1]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Verifier si les champs par défaut d'un auteur sont remplie.

        //dd($request);
        $request->validate([
            'titre'=> 'required',
            'niveau'=>'required|not_in:--Selectionner--',
            'type'=>'required|not_in:--Selectionner--',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'auteur0'=>'required',
            'categorie0'=>'required|not_in:--Selectionner--',
            'ISBN'=>'required',
            'resume'=>'required',
            'nombre_exemplaire'=>'required',
            'etat'=>'required',
            'id_classification_dewey_centaine'=>'required|not_in:--Selectionner--',
            'id_classification_dewey_dizaine'=>'required|not_in:--Selectionner--',
        ]);

        $livres_papier = LivresPapierService::exist($request["ISBN"]);

        if (! $livres_papier){
            // Creation d'un ou des auteurs .
            $auteurs = AuteurServices::enregistrerAuteur($request);
            // Creation de l'ouvrage
            $ouvrage = OuvrageService::enregisterOuvrage($request, $auteurs);
            // Création d'un ouvrage physique
            $ouvragePhysique = OuvragesPhysiqueService::enregisterOuvragePhysique($request, $ouvrage);
            //dd($ouvragePhysique);
            $list_categories = OuvrageService::convertDataToArray($request, "categorie");
            //dd($list_categories);
            $categories = OuvrageService::convertObjetToArray($list_categories, "categorie");
            //dd($categories);
            LivresPapier::create([
                'categorie'=>$categories,
                'ISBN'=>strtoupper($request["ISBN"]),
                'id_ouvrage_physique'=>$ouvragePhysique->id_ouvrage_physique
            ]);
            return redirect()->route("listeLivresPapier");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function show(LivresPapier $livresPapier)
    {
        //ddd($livresPapier->id_livre_papier);
        return view('livresPapier.show')->with("livrePapier", $livresPapier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(LivresPapier $livresPapier)
    {
        //dd($livresPapier);
        $niveausTypesLanguesAuteurs = OuvrageService::getNiveausTypesLanguesAuteurs();
        $categories = LivresPapierService::getCategories();
        $classifications_dewey = OuvragesPhysiqueService::getClassificationsDewey();


        return view('livresPapier.edite')->with([
            "livresPapier" => $livresPapier,
            'niveaus'=> $niveausTypesLanguesAuteurs[0],
            'types'=>$niveausTypesLanguesAuteurs[1],
            'langues'=>$niveausTypesLanguesAuteurs[2],
            'auteurs'=>$niveausTypesLanguesAuteurs[3],
            'categories'=>$categories,
            'classification_dewey_centaines'=>$classifications_dewey[0],
            'classification_dewey_dizaines'=>$classifications_dewey[1],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LivresPapier $livresPapier)
    {
        $request->validate([
            'titre'=> 'required',
            'niveau'=>'required|not_in:--Selectionner--',
            'type'=>'required|not_in:--Selectionner--',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'auteur0'=>'required',
            'categorie0'=>'required|not_in:--Selectionner--',
            'ISBN'=>'required',
            'resume'=>'required',
            'nombre_exemplaire'=>'required',
            'etat'=>'required',
            'id_classification_dewey_centaine'=>'required|not_in:--Selectionner--',
            'id_classification_dewey_dizaine'=>'required|not_in:--Selectionner--',
        ]);

        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $livresPapier->id_ouvrage_physique)->first();
        OuvragesPhysiqueService::updateOuvrage($ouvragePhysique, $request["nombre_exemplaire"], $request["etat"], $request["disponibilite"]);
        OuvrageService::updateOuvrage($request, $ouvragePhysique);

        return redirect()->route('listeLivresPapier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function destroy(LivresPapier $livresPapier)
    {
        $id_ouvrage = $livresPapier->ouvragePhysique->ouvrage->id_ouvrage;
        $id_ouvrage_physique =  $livresPapier->ouvragePhysique->id_ouvrage_physique;

        $livresPapier->delete();
        OuvragesPhysique::all()->where("id_ouvrage_physique", $id_ouvrage_physique)->first()->delete();
        Ouvrage::all()->where("id_ouvrage", $id_ouvrage)->first()->delete();
        //dd("suppression");
        return redirect()->route('listeLivresPapier');
    }
}

