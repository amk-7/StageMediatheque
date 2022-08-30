<?php

namespace App\Http\Controllers;

use App\Helpers\AuteurHelpers;
use App\Helpers\LivreHelper;
use App\Helpers\LivrePapierHelper;
use App\Helpers\OuvrageHelper;
use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\Auteur;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use Carbon\Carbon;
use App\Models\OuvragesPhysique;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaine;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Ramsey\Uuid\Type\Integer;

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
        $niveausTypesLanguesAuteurs = OuvrageHelper::getNiveausTypesLanguesAuteurs();
        $categories = LivreHelper::getCategories();

        return view('livresPapier.index')->with([
            'niveaus'=> $niveausTypesLanguesAuteurs[0],
            'types'=>$niveausTypesLanguesAuteurs[1],
            'langues'=>$niveausTypesLanguesAuteurs[2],
            'auteurs'=>$niveausTypesLanguesAuteurs[3],
            'categories'=>$categories,
            'livresPapiers'=>array()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        $niveausTypesLanguesAuteurs = OuvrageHelper::getNiveausTypesLanguesAuteurs();
        $categories = LivreHelper::getCategories();
        $classifications_dewey = OuvragesPhysiqueHelper::getClassificationsDewey();

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

        $livres_papier = LivrePapierHelper::livrePapierExist($request["ISBN"], $request["titre"], (Integer) $request["annee_apparution"]);

        if ($livres_papier!=null){
            return redirect()->route("formulaireModificationLivrePapier", compact("livres_papier"));
        }

        // Creation d'un ou des auteurs .
        $auteurs = AuteurHelpers::enregistrerAuteur($request);
        // Creation de l'ouvrage
        $ouvrage = OuvrageHelper::enregisterOuvrage($request, $auteurs);
        // Création d'un ouvrage physique
        $ouvragePhysique = OuvragesPhysiqueHelper::enregisterOuvragePhysique($request, $ouvrage);
        //dd($ouvragePhysique);
        $list_categories = OuvrageHelper::convertDataToArray($request, "categorie");
        //dd($list_categories);
        $categories = OuvrageHelper::convertObjetToArray($list_categories, "categorie");
        //dd($categories);
        LivresPapier::create([
           'categorie'=>$categories,
           'ISBN'=>strtoupper($request["ISBN"]),
           'id_ouvrage_physique'=>$ouvragePhysique->id_ouvrage_physique
       ]);
        return redirect()->route("listeLivresPapier");

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
        $niveausTypesLanguesAuteurs = OuvrageHelper::getNiveausTypesLanguesAuteurs();
        $categories = LivrePapierHelper::getCategories();
        $classifications_dewey = OuvragesPhysiqueHelper::getClassificationsDewey();


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
        OuvragesPhysiqueHelper::updateOuvrage($ouvragePhysique, $request["nombre_exemplaire"], $request["etat"], $request["disponibilite"]);
        OuvrageHelper::updateOuvrage($request, $ouvragePhysique);

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

