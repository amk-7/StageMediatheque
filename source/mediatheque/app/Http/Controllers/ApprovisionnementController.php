<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\OuvragesPhysique;
use App\Models\Personnel;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class ApprovisionnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $approvisionnements = Approvisionnement::all();
        return view('approvisionnement.index')->with('approvisionnements', $approvisionnements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $ouvragesPhysique = OuvragesPhysique::all();
        $personnels = Personnel::all();
        return view('approvisionnement.create')->with([
            "ouvragesPhysique"=>$ouvragesPhysique,
            "personnels"=>$personnels
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
        //dd($request);

        //Rechercher L'ouvrage physique.
        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $request["id_ouvrage_physique"]);

        $ouvragePhysique->nombre_exemplaie += $request["nombre_exemmplaire"];

        $approvisionnement = Approvisionnement::create([
            'nombre_exemplaire' => $request->nombre_exemplaire,
            'date_approvisionnement' => $request->date_approvisionnement,
            'id_personnel'=>$request["id_personnel"],
            'id_ouvrage_physique'=>$ouvragePhysique->id_ouvrage_physique
        ]);
        return redirect()->route('approvisionnement.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function show(Approvisionnement $approvisionnement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function edit(Approvisionnement $approvisionnement)
    {
        //
        return view('approvisionnement.edit')->with('approvisionnement', $approvisionnement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approvisionnement $approvisionnement)
    {
        //
        $approvisionnement->update(array([
            'nombre_exemplaire' => $request['nombre_exemplaire'],
            'date_approvisionnement' => $request['date_approvisionnement']
        ]));
        return redirect()->route('approvisionnement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approvisionnement $approvisionnement)
    {
        //
        $approvisionnement->delete();
        return redirect()->route('approvisionnement.index');

    }
}
