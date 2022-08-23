<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $auteurs = Auteur::all();
        return view('auteur.index')->with('auteurs', $auteurs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('auteur.create');
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
        $auteur = Auteur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'date_deces' => $request->date_deces
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auteur  $auteur
     * @return \Illuminate\Http\Response
     */
    public function show(Auteur $auteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auteur  $auteur
     * @return \Illuminate\Http\Response
     */
    public function edit(Auteur $auteur)
    {
        //
        return view('auteur.edit')->with('auteur', $auteur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auteur  $auteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auteur $auteur)
    {
        //
        $auteur->update(array(
            'nom' => $request["nom"],
            'prenom' => $request["prenom"],
            'date_naissance' => $request["date_naissance"],
            'date_deces' => $request["date_deces"]
        ));
        return redirect()->route('auteur.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auteur  $auteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auteur $auteur)
    {
        //
        $auteur->delete();
        return redirect()->route('auteur.index');
    }
}
