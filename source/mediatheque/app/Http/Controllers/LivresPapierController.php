<?php

namespace App\Http\Controllers;

use App\Helpers\LivrePapierHelper;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Service\AuteurServices;
use App\Service\LivresPapierService;
use App\Service\OuvrageService;
use App\Service\OuvragesPhysiqueService;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $niveausTypesLanguesAuteursAnnee = OuvrageService::getNiveausTypesLanguesAuteursAnnee();
        $categories = LivresPapierService::getCategories();
        $livresPapiers = LivresPapier::all();

        return view('livresPapier.index')->with([
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
            'annees' => $niveausTypesLanguesAuteursAnnee[4],
            'id_livre_papier'=>LivresPapierService::getAllIDLivrePapier($livresPapiers)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        $niveausTypesLanguesAuteursAnnee = OuvrageService::getNiveausTypesLanguesAuteursAnnee();
        $categories = LivresPapierService::getCategories();
        $classifications_dewey = OuvragesPhysiqueService::getClassificationsDewey();

        return view('livresPapier.create')->with([
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
            'classification_dewey_dizaines'=> $classifications_dewey[1],
            'classification_dewey_centaines'=> $classifications_dewey[0],
            'annees' => $niveausTypesLanguesAuteursAnnee[4],
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
        Validator::make($request->all(), [
            'ISBN'=>['required',
                function ($attribute, $value, $flail){
                    if (LivresPapierService::exist($value)!=null){
                        $flail("L' ".$attribute." existe déjà");
                    }
                }
            ],
        ])->validate();

        $request->validate([
            'titre'=> 'required',
            'niveau'=>'required|not_in:--Selectionner--',
            'type'=>'required|not_in:--Selectionner--',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'auteur0'=>'required',
            'categorie0'=>'required|not_in:--Selectionner--',
            'resume'=>'required',
            'nombre_exemplaire'=>'required',
            'id_classification_dewey_centaine'=>'required|not_in:--Selectionner--',
            'id_classification_dewey_dizaine'=>'required|not_in:--Selectionner--',
        ]);

        // Creation d'un ou des auteurs .
        $auteurs = AuteurServices::enregistrerAuteur($request);
        // Creation de l'ouvrage
        $ouvrage = OuvrageService::enregisterOuvrage($request, $auteurs);
        // Création d'un ouvrage physique
        $ouvragePhysique = OuvragesPhysiqueService::enregisterOuvragePhysique($request, $ouvrage);
        //dd($ouvragePhysique);
        $categories = OuvrageService::convertDataToArray($request, "categorie");
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
        $niveausTypesLanguesAuteursAnnee = OuvrageService::getNiveausTypesLanguesAuteursAnnee();
        $categories = LivresPapierService::getCategories();
        $classifications_dewey = OuvragesPhysiqueService::getClassificationsDewey();


        return view('livresPapier.edite')->with([
            "livresPapier" => $livresPapier,
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
            'classification_dewey_centaines'=>$classifications_dewey[0],
            'classification_dewey_dizaines'=>$classifications_dewey[1],
            'annees' => $niveausTypesLanguesAuteursAnnee[4],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\RedirectResponse
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
            'id_classification_dewey_centaine'=>'required|not_in:--Selectionner--',
            'id_classification_dewey_dizaine'=>'required|not_in:--Selectionner--',
        ]);

        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $livresPapier->id_ouvrage_physique)->first();
        OuvragesPhysiqueService::updateOuvrage($ouvragePhysique, $request["nombre_exemplaire"]);
        OuvrageService::updateOuvrage($request, $ouvragePhysique);

        return redirect()->route('listeLivresPapier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(LivresPapier $livresPapier)
    {
        $id_ouvrage = $livresPapier->id_livre_papier;

        $livresPapier->delete();
        OuvragesPhysique::all()->where("id_ouvrage_physique", $id_ouvrage)->first()->delete();
        Ouvrage::all()->where("id_ouvrage", $id_ouvrage)->first()->delete();
        //dd("suppression");
        return redirect()->route('listeLivresPapier');
    }

}

