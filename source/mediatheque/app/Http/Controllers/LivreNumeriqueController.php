<?php

namespace App\Http\Controllers;

use App\Models\LivresNumerique;
use App\Models\LivresPapier;
use App\Models\OuvragesElectronique;
use App\Service\AuteurService;
use App\Service\GobaleService;
use App\Service\LivresPapierService;
use App\Service\OuvragesElectroniqueService;
use App\Service\OuvrageService;
use App\Service\OuvragesPhysiqueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LivreNumeriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return "livres electronique";
        $livresNumeriques = LivresNumerique::all();
        return view('livresNumerique.index')->with('livresNumeriques', $livresNumeriques);
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

        return view('livresNumerique.create')->with([
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
            'annees' => $niveausTypesLanguesAuteursAnnee[4],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
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
            'niveau'=>'required|not_in:Sélectionner niveau',
            'type'=>'required|not_in:Sélectionner type',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'data_auteurs'=>'required',
            'data_categorie'=>'required',
            'resume'=>'required',
            'url'=>'required',
        ]);

        // Creation d'un ou des auteurs .
        $data_auteurs = GobaleService::extractLineToData($request->data_auteurs);
        $auteurs = AuteurService::enregistrerAuteur($data_auteurs);
        // Creation de l'ouvrage
        $ouvrage = OuvrageService::enregisterOuvrage($request, $auteurs);
        // Création d'un ouvrage electronique
        $ouvrageElectronique = OuvragesElectroniqueService::enregistrerOuvrageElectronique($ouvrage, $request->url);
        //dd($ouvrageElectronique);
        $categories_data = GobaleService::extractLineToData($request->data_categorie);
        $categories = [];
        foreach ($categories_data as $categorie_array){
            array_push($categories, $categorie_array[0]);
        }
        //dd($request["ISBN"]);
        LivresNumerique::create([
            'categorie'=>$categories,
            'ISBN'=>strtoupper($request["ISBN"]),
            'id_ouvrage_electronique'=>$ouvrageElectronique->id_ouvrage_electronique,
        ]);
        //dd(LivresNumerique::find(1));
        return redirect()->route('listeLivresNumerique');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\Response
     */
    public function show(LivresNumerique $livreNumerique)
    {
        //
        return view('livresNumerique.show')->with('livreNumerique', $livreNumerique);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\Response
     */
    public function edit(LivresNumerique $livreNumerique)
    {
        //
        //return view('livresNumerique.edit')->with('livreNumerique', $livreNumerique);

        $niveaus = [
            '1er degré', '2è degré', '3è degré', 'université'
        ];

        $types = [
            'roman', 'manuel scolaire', 'document technique', 'document pédagogique', 'bande dessinée', 'journeaux', 'nouvelle'
        ];

        $langues = [
            'français', 'anglais', 'allemand'
        ];

        $categories = [
            'français', 'anglais', 'allemand', 'physique', 'education',
            'hydrolique', 'musique et art', 'théologie', 'philosophie', 'zoologie', 'géologie', 'mathématique générale',
            'bibliographie', 'physique', 'médécine', 'comptabilité', 'droit'
        ];

        return view('livresNumerique.edit')->with([
            'livreNumerique'=>$livreNumerique,
            'niveaus'=> $niveaus,
            'types'=>$types,
            'langues'=>$langues,
            'categories'=>$categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LivresNumerique $livreNumerique)
    {
        //
        $livreNumerique->update(array([
            'catégorie' => $request->categorie,
            'ISBN' => $request->ISBN
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\Response
     */
    public function destroy(LivresNumerique $livreNumerique)
    {
        //
        $livreNumerique->delete();
        return redirect()->route('livresNumerique.index');
    }
}
