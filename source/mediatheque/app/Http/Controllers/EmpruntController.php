<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use Illuminate\Http\Request;
use App\Service\OuvragesPhysiqueService;
use App\Service\PersonnelService;
use App\Service\AbonneService;
use App\Service\EmpruntService;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $emprunts = Emprunt::all();
        return view('emprunt.index')->with('emprunts', $emprunts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('emprunt.create')->with([
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
        //

        //dd($request);

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'nom_abonne'=>'required',
            'prenom_abonne'=>'required',
            'data'=>'required',
            'duree_emprunt' => 'required',

        ]);

        $nbjour = (int) $request->duree_emprunt;
        $nbjour = $nbjour * 7;
        $date = date_create();
        date_add($date,date_interval_create_from_date_string("$nbjour days"));
        $date_retour = date_format($date, 'Y-m-d');

        $emprunt = Emprunt::create([
            'date_emprunt' => date('Y-m-d'),
            'date_retour' => $date_retour,
            'id_abonne' => $request->prenom_abonne,
            'id_personnel' => $request->prenom,
        ]);

        EmpruntService::enregistrerUnEmprunt($request->data, $emprunt);

        return redirect()->route("listeEmprunts");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Http\Response
     */
    public function show(Emprunt $emprunt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Http\Response
     */
    public function edit(Emprunt $emprunt)
    {
        //
        return view('emprunt.edit')->with([
            'emprunt'=>$emprunt,
            "personnels" => json_encode(PersonnelService::getPersonnelWithAllAttribut()),
            "abonnes" => json_encode(AbonneService::getAbonnesWithAllAttribut()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emprunt $emprunt)
    {
        //
        $emprunt->update(array([
            'date_emprunt' => $request['date_emprunt'],
            'date_retour' => $request['date_retour']
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emprunt $emprunt)
    {
        //
        $emprunt->delete();
        return redirect()->route('emprunt.index');
    }
}
