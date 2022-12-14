<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Restitution;
use App\Service\AbonneService;
use App\Service\GlobaleService;
use App\Service\LignesEmprunt;
use App\Service\LignesEmpruntService;
use App\Service\LignesRestitutionService;
use App\Service\RestitutionService;
use Illuminate\Http\Request;

class RestitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $restitution = Restitution::all();

        return view('restitution.index')->with([
            'restitutions' => $restitution,
            'etat' => $request->etat,
            'search_by' => $request->search_by,
            'abonnes' => json_encode(AbonneService::getAbonnesWithAllAttribut()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Emprunt $emprunt)
    {
        //dd(LignesEmpruntService::getAllLignesEmpruntByEmprunt($emprunt));
        return view('restitution.create')->with([
            "emprunt" => $emprunt,
            "lignes_emprunt" => json_encode(LignesEmpruntService::getAllLignesEmpruntByEmprunt($emprunt)),
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
            'data'=>'required',
        ]);
        $datas = GlobaleService::extractLineToData($request->data);

        $id_emprunt = $datas[0][0];

        $restitution = Restitution::create([
            'etat' => RestitutionService::etatRestitution($id_emprunt, count($datas)-2), //verifier si la restitution est partielle ou complet.
            'date_restitution' => date('Y-m-d'),
            'id_personnel' => $datas[0][1],
            'id_abonne' => $datas[0][2],
            'id_emprunt' => $id_emprunt,
        ]);

        LignesRestitutionService::enregistrerLignesRestitution($datas, $restitution->id_restitution, $id_emprunt);
        return redirect()->route('listeRestitutions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restitution  $restitution
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Restitution $restitution)
    {
        return view('restitution.show')->with([
            'restitution' => $restitution,
            'lignes_emprunt' => json_encode(LignesEmpruntService::getAllLignesEmpruntByEmprunt($restitution->emprunt)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restitution  $restitution
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Restitution $restitution)
    {
        return view('restitution.edite')->with([
            'restitution' => $restitution,
            'lignes_emprunt' => json_encode(LignesEmpruntService::getAllLignesEmpruntByEmprunt($restitution->emprunt)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Request  $restitution
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Restitution $restitution)
    {
        $request->validate([
            'data'=>'required',
        ]);
        $datas = GlobaleService::extractLineToData($request->data);
        LignesRestitutionService::enregistrerLignesRestitution($datas, $restitution->id_restitution, $restitution->id_emprunt);
        $restitution->etat = RestitutionService::etatRestitutionUpdate($restitution);
        $restitution->save();

        return redirect()->route('listeRestitutions');
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
