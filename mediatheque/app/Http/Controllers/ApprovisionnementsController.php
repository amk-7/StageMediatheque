<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\OuvragesPhysique;
use App\Models\Ouvrage;
use App\Models\Personnel;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class ApprovisionnementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $approvisionnements = Approvisionnement::paginate(10);
        $approvisionnements->sortBy('date_approvisonnement');
        return view('approvisionnements.index')->with('approvisionnements', $approvisionnements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('approvisionnements.create')->with([
            "ouvrages" => json_encode(Ouvrage::all()),
            "personnels" => json_encode(Personnel::fullAttributs()),
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

        $request->validate([
            'data' => 'required',
        ]);

        Approvisionnement::enregistrerPlusieursApprosionnement($request->data);
        return redirect()->route('approvisionnements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function show(Approvisionnement $approvisionnement)
    {
        return "Consultation";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Approvisionnement $approvisionnement)
    {
        return view('approvisionnements.edite')->with([
            'ouvragesPhysique' => OuvragesPhysique::all(),
            'personnels' => Personnel::all(),
            'approvisionnements' => $approvisionnement,
        ]);
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
        $delta = $request->nombre_exemplaire - $approvisionnement->nombre_exemplaire;
        $approvisionnement->ouvrage->augmenterNombreExemplaire($delta);
        $approvisionnement->ouvrage->save();

        $approvisionnement->nombre_exemplaire= $request->nombre_exemplaire;
        $approvisionnement->date_approvisionnement = date('m-d-Y');
        $approvisionnement->save();

        return redirect()->route('approvisionnements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approvisionnement $approvisionnement)
    {
        $approvisionnement->ouvrage->augmenterNombreExemplaire($approvisionnement->nombre_exemplaire * -1);
        $approvisionnement->delete();
        return redirect()->route('approvisionnements.index');
    }
}
