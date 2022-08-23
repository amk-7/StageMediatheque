<?php

namespace App\Http\Controllers;

use App\Helpers\OuvragePhysiqueHelper;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaines;
use App\Models\DocumentAudioVisuel;
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
<<<<<<< HEAD
        //
        $documentAudioVisuels = DocumentAudioVisuel::all();
        return view('documentAudioVisuel.index')->with('documentAudioVisuels', $documentAudioVisuels);
=======
        $documentAudioVisuel = DocumentAudioVisuel::all();
        return view("documentAudioVisuel.index", compact("documentAudioVisuel"))->paginate(25);
>>>>>>> dcbac1ccfdb22f9663055bb79b5286c3298d4a4e
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        //
        return view('documentAudioVisuel.create');
=======
        $niveaus = [
            '1er degré', '2è degré', '3è degré', 'université'
        ];

        $types = [

        ];

        $langues = [
            'français', 'anglais', 'allemend'
        ];

        $categories = [

        ];

        $classification_dewey_centaines = ClassificationDeweyCentaine::all();

        $classification_dewey_dizaines = ClassificationDeweyDizaines::all();

        return view('documentAudioVisuel.create')->with([
            'niveaus'=> $niveaus,
            'types'=>$types,
            'langues'=>$langues,
            'categories'=>$categories,
            'classification_dewey_centaines'=>$classification_dewey_centaines,
            'classification_dewey_dizaines'=>$classification_dewey_dizaines
        ]);
>>>>>>> dcbac1ccfdb22f9663055bb79b5286c3298d4a4e
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        //
        $documentAudioVisuel = DocumentAudioVisuel::create([
            'genre' => $request->genre,
            'ISAN' => $request->ISAN
        ]);
        return redirect()->route('documentAudioVisuel.index');
=======
        //--coder--
        return redirect()->route("documentAudioVisuel.index");
>>>>>>> dcbac1ccfdb22f9663055bb79b5286c3298d4a4e
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentAudioVisuel $documentAudioVisuel)
    {
        return view("documentAudioVisuel.show", compact("documentAudioVisuel"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentAudioVisuel $documentAudioVisuel)
    {
<<<<<<< HEAD
        //
        return view('documentAudioVisuel.edit')->with('documentAudioVisuel', $documentAudioVisuel);
=======
        return view("documentAudioVisuel.edite", compact("documentAudioVisuel"));
>>>>>>> dcbac1ccfdb22f9663055bb79b5286c3298d4a4e
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentAudioVisuel $documentAudioVisuel)
    {
<<<<<<< HEAD
        //
        $documentAudioVisuel->update(array([
            'genre' => $request['genre'],
            'ISAN' => $request['ISAN']
        ]));
        return redirect()->route('documentAudioVisuel.index');
=======
        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $documentAudioVisuel->id_ouvrage_physique);
        OuvragePhysiqueHelper::updateOuvrage($ouvragePhysique, $request["nombre_exemplaire"], $request["etat"], $request["disponibilite"]);

        return redirect()->route("documentAudioVisuel.index");
>>>>>>> dcbac1ccfdb22f9663055bb79b5286c3298d4a4e
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentAudioVisuel $documentAudioVisuel)
    {
<<<<<<< HEAD
        //
        $documentAudioVisuel->delete();
        return redirect()->route('documentAudioVisuel.index');
=======
        $documentAudioVisuel->delete();
>>>>>>> dcbac1ccfdb22f9663055bb79b5286c3298d4a4e
    }
}
