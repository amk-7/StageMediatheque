<?php

namespace App\Http\Controllers;

use App\Models\DocumentAudioVisuelElectronique;
use Illuminate\Http\Request;

class DocumentAudioVisuelElectroniqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $documentAudioVisuelElectroniques = DocumentAudioVisuelElectronique::all();
        return view('documentAudioVisuelElectronique.index')->with('documentAudioVisuelElectroniques', $documentAudioVisuelElectroniques);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('documentAudioVisuelElectronique.create');
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
        $documentAudioVisuelElectronique = DocumentAudioVisuelElectronique::create([
            'genre' => $request->genre,
            'ISAN' => $request->ISAN
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentAudioVisuelElectronique  $documentAudioVisuelElectronique
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentAudioVisuelElectronique $documentAudioVisuelElectronique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentAudioVisuelElectronique  $documentAudioVisuelElectronique
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentAudioVisuelElectronique $documentAudioVisuelElectronique)
    {
        //
        return view('documentAudioVisuelElectronique.edit')->with('documentAudioVisuelElectronique', $documentAudioVisuelElectronique);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentAudioVisuelElectronique  $documentAudioVisuelElectronique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentAudioVisuelElectronique $documentAudioVisuelElectronique)
    {
        //
        $documentAudioVisuelElectronique->update(array([
            'genre' => $request['genre'],
            'ISAN' => $request['ISAN']
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentAudioVisuelElectronique  $documentAudioVisuelElectronique
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentAudioVisuelElectronique $documentAudioVisuelElectronique)
    {
        //
        $documentAudioVisuelElectronique->delete();
        return redirect()->route('documentAudioVisuelElectronique.index');
    }
}
