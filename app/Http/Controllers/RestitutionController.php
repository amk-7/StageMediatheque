<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Restitution;
use App\Models\Abonne;
use App\Models\LignesRestitution;
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
        $restitution = Restitution::paginate(10);

        return view('restitution.index')->with([
            'restitutions' => $restitution,
            'etat' => $request->etat,
            'search_by' => $request->search_by,
            'abonnes' => json_encode(Abonne::getAbonnesWithAllAttribut()),
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
            "lignes_emprunt" => json_encode($emprunt->getAllLignesEmpruntByEmprunt()),
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
        $datas = Controller::extractLineToData($request->data);

        $id_emprunt = $datas[0][0];

        $restitution = Restitution::create([
            'etat' => Restitution::etatRestitution($id_emprunt, count($datas) - 2), //verifier si la restitution est partielle ou complet.
            'date_restitution' => date('Y-m-d'),
            'id_personnel' => $datas[0][1],
            'id_abonne' => $datas[0][2],
            'id_emprunt' => $id_emprunt,
        ]);

        LignesRestitution::enregistrerLignesRestitution($datas, $restitution->id_restitution, $id_emprunt);
        return redirect()->route('restitutions.index');
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
            'lignes_emprunt' => json_encode($restitution->emprunt->getAllLignesEmpruntByEmprunt()),
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
            'lignes_emprunt' => json_encode($restitution->emprunt->getAllLignesEmpruntByEmprunt()),
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
            'data' => 'required',
        ]);
        $datas = Controller::extractLineToData($request->data);
        LignesRestitution::enregistrerLignesRestitution($datas, $restitution->id_restitution, $restitution->id_emprunt);
        $restitution->etat = Restitution::etatRestitutionUpdate($restitution);
        $restitution->save();

        return redirect()->route('restitutions.index');
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
