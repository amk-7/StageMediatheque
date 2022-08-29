<?php

namespace App\Http\Controllers;

use App\Helpers\OuvragePhysiqueHelper;
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


        $niveaus = [
            '1er degré', '2è degré', '3è degré', 'université'
        ];

        $types = [

        ];

        $langues = [
            'français', 'anglais', 'allemend'
        ];

        $genres = [

        ];

        $classification_dewey_centaines = ClassificationDeweyCentaine::all();

        $classification_dewey_dizaines = ClassificationDeweyDizaine::all();

        return view('documentAudioVisuel.create')->with([
            'niveaus'=> $niveaus,
            'types'=>$types,
            'langues'=>$langues,
            'genres'=>$genres,
            'classification_dewey_centaines'=>$classification_dewey_centaines,
            'classification_dewey_dizaines'=>$classification_dewey_dizaines
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

        //
        $documentAudioVisuel = DocumentsAudioVisuel::create([
            'genre' => $request->genre,
            'ISAN' => $request->ISAN
        ]);
        return redirect()->route('documentAudioVisuel.index');

        //--coder--
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
        OuvragePhysiqueHelper::updateOuvrage($ouvragePhysique, $request["nombre_exemplaire"], $request["etat"], $request["disponibilite"]);

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
