<?php

namespace App\Http\Controllers;

use App\Models\Restitution;
use App\Service\AbonneService;
use App\Service\OuvrageRestitutionService;
use App\Service\OuvragesPhysiqueService;
use App\Service\PersonnelService;
use Illuminate\Http\Request;

class RestitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('Restitution.index')->with([
            'restitutions' => Restitution::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('Restitution.create')->with([
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'nom_abonne'=>'required',
            'prenom_abonne'=>'required',
            'data'=>'required',
        ]);

        //dd($request);

        OuvrageRestitutionService::enregistrerRestitutionOuvrages($request->data, $request->prenom, $request->prenom_abonne);
        return "Succes";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restitution  $restitution
     * @return \Illuminate\Http\Response
     */
    public function show(Restitution $restitution)
    {
        return "Show ".$restitution->id_restitution;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restitution  $restitution
     * @return \Illuminate\Http\Response
     */
    public function edit(Restitution $restitution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Request  $restitution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restitution $restitution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restitution  $restitution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restitution $restitution)
    {
        //
    }
}
