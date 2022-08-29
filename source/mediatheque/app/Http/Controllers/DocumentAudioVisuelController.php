<?php

namespace App\Http\Controllers;

use App\Helpers\AuteurHelpers;
use App\Helpers\DocumentsAudioVisuelHelper;
use App\Helpers\OuvrageHelper;
use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaine;
use App\Models\DocumentsAudioVisuel;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;

class DocumentAudioVisuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        $documentAudioVisuels = DocumentsAudioVisuel::all();
        return view('documentAudioVisuel.index')->with('documentAudioVisuels', $documentAudioVisuels);

        $documentAudioVisuel = DocumentsAudioVisuel::all();
        return view("documentAudioVisuel.index", compact("documentAudioVisuel"))->paginate(25);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $niveausTypesLanguesAuteurs = OuvrageHelper::getNiveausTypesLanguesAuteurs();
        $genres = DocumentsAudioVisuelHelper::getGenre();
        $classifications_dewey = OuvragesPhysiqueHelper::getClassificationsDewey();

        return view('documentAudioVisuel.create')->with([
            'niveaus'=> $niveausTypesLanguesAuteurs[0],
            'types'=>$niveausTypesLanguesAuteurs[1],
            'langues'=>$niveausTypesLanguesAuteurs[2],
            'auteurs'=>$niveausTypesLanguesAuteurs[3],
            'genres'=>$genres,
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
        $request->validate([
            'titre'=> 'required',
            'niveau'=>'required|not_in:--Selectionner--',
            'type'=>'required|not_in:--Selectionner--',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'auteur0'=>'required',
            'genre0'=>'required|not_in:--Selectionner--',
            'ISAN'=>'required',
            'resume'=>'required',
            'nombre_exemplaire'=>'required',
            'etat'=>'required',
            'id_classification_dewey_centaine'=>'required|not_in:--Selectionner--',
            'id_classification_dewey_dizaine'=>'required|not_in:--Selectionner--',

        ]);

        // Creation d'un ou des auteurs .
        $auteurs = AuteurHelpers::enregistrerAuteur($request);
        // Creation de l'ouvrage
        $ouvrage = OuvrageHelper::enregisterOuvrage($request, $auteurs);
        // Création d'un ouvrage physique
        $ouvragePhysique = OuvragesPhysiqueHelper::enregisterOuvragePhysique($request, $ouvrage);
        //dd($ouvragePhysique);
        $list_genre = OuvrageHelper::convertDataToArray($request, "genre");
        //dd($list_genre);
        $genres = OuvrageHelper::convertObjetToArray($list_genre, "genre");
        //dd($genres);

        $documentAudioVisuel = DocumentsAudioVisuel::create([
            'genre' => $request->genres,
            'ISAN' => $request->ISAN
        ]);

        //-- verifier si l'objet n'exist pas --

        return redirect()->route("documentAudioVisuel.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentsAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentsAudioVisuel $documentAudioVisuel)
    {
        return view("documentAudioVisuel.show", compact("documentAudioVisuel"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentsAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentsAudioVisuel $documentAudioVisuel)
    {
        //
        return view('documentAudioVisuel.edit')->with('documentAudioVisuel', $documentAudioVisuel);

        return view("documentAudioVisuel.edite", compact("documentAudioVisuel"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentsAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentsAudioVisuel $documentAudioVisuel)
    {

        //
        $documentAudioVisuel->update(array([
            'genre' => $request['genre'],
            'ISAN' => $request['ISAN']
        ]));
        return redirect()->route('documentAudioVisuel.index');

        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $documentAudioVisuel->id_ouvrage_physique);
        OuvragesPhysiqueHelper::updateOuvrage($ouvragePhysique, $request["nombre_exemplaire"], $request["etat"], $request["disponibilite"]);

        return redirect()->route("documentAudioVisuel.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentsAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentsAudioVisuel $documentAudioVisuel)
    {

        //
        $documentAudioVisuel->delete();
        return redirect()->route('documentAudioVisuel.index');

        $documentAudioVisuel->delete();

    }
}
