<?php

namespace App\Http\Controllers;

use App\Models\LivresNumerique;
use Illuminate\Http\Request;

class LivreNumeriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return "livres electronique";
        $livresNumeriques = LivresNumerique::all();
        return view('livresNumerique.index')->with('livresNumeriques', $livresNumeriques);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $niveaus = [
            '1er degré', '2è degré', '3è degré', 'université'
        ];

        $types = [
            'roman', 'manuel scolaire', 'document technique', 'document pédagogique', 'bande dessinée', 'journeaux', 'nouvelle'
        ];

        $langues = [
            'français', 'anglais', 'allemand'
        ];

        $categories = [
            'français', 'anglais', 'allemand', 'physique', 'education',
            'hydrolique', 'musique et art', 'théologie', 'philosophie', 'zoologie', 'géologie', 'mathématique générale',
            'bibliographie', 'physique', 'médécine', 'comptabilité', 'droit'
        ];

        return view('livresNumerique.create')->with([
            'niveaus'=> $niveaus,
            'types'=>$types,
            'langues'=>$langues,
            'categories'=>$categories
        ]);

        //return view('livresNumerique.create');
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
        /*
        $livreNumerique = LivresNumerique::create([
            'catégorie' => $request->categorie,
            'ISBN' => $request->ISBN
        ]);*/
        return redirect()->route('livresNumerique.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\Response
     */
    public function show(LivresNumerique $livreNumerique)
    {
        //
        return view('livresNumerique.show')->with('livreNumerique', $livreNumerique);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\Response
     */
    public function edit(LivresNumerique $livreNumerique)
    {
        //
        //return view('livresNumerique.edit')->with('livreNumerique', $livreNumerique);

        $niveaus = [
            '1er degré', '2è degré', '3è degré', 'université'
        ];

        $types = [
            'roman', 'manuel scolaire', 'document technique', 'document pédagogique', 'bande dessinée', 'journeaux', 'nouvelle'
        ];

        $langues = [
            'français', 'anglais', 'allemand'
        ];

        $categories = [
            'français', 'anglais', 'allemand', 'physique', 'education',
            'hydrolique', 'musique et art', 'théologie', 'philosophie', 'zoologie', 'géologie', 'mathématique générale',
            'bibliographie', 'physique', 'médécine', 'comptabilité', 'droit'
        ];

        return view('livresNumerique.edit')->with([
            'livreNumerique'=>$livreNumerique,
            'niveaus'=> $niveaus,
            'types'=>$types,
            'langues'=>$langues,
            'categories'=>$categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LivresNumerique $livreNumerique)
    {
        //
        $livreNumerique->update(array([
            'catégorie' => $request->categorie,
            'ISBN' => $request->ISBN
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\Response
     */
    public function destroy(LivresNumerique $livreNumerique)
    {
        //
        $livreNumerique->delete();
        return redirect()->route('livresNumerique.index');
    }
}
