<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\OuvragesPhysique;
use App\Models\Personnel;
use App\Service\AbonneService;
use App\Service\ApprovisionnementService;
use App\Service\OuvragesPhysiqueService;
use App\Service\PersonnelService;
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
        $approvisionnements = Approvisionnement::all();
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
            "livre_papier" => json_encode(OuvragesPhysiqueService::getLivrePapierWithAllAttribute()),
            "document_audio_visuel" => json_encode(OuvragesPhysiqueService::getDocAVWithAllAttribute()),
            "personnels" => json_encode(PersonnelService::getPersonnelWithAllAttribut()),
            "abonnes" => json_encode(AbonneService::getAbonnesWithAllAttribut()),
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
        //dd($request);
        $request->validate([
            'data'=>'required',
        ]);

        ApprovisionnementService::enregistrerPlusieursApprosionnement($request->data);
        return redirect()->route('listeApprovisionnements');
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
            'ouvragesPhysique'=>OuvragesPhysique::all(),
            'personnels'=>Personnel::all(),
            'approvisionnements'=> $approvisionnement,
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
        //
        $approvisionnement->update(array([
            'nombre_exemplaire' => $request['nombre_exemplaire'],
            'date_approvisionnement' => $request['date_approvisionnement']
        ]));

        return redirect()->route('listeApprovisionnements');
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
        return redirect()->route('approvisionnements.index');

    }
}
