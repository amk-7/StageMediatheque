<?php

namespace App\Http\Controllers;

use App\Models\DocumentAudioVisuel;
use Illuminate\Http\Request;

class DocumentAudioVisuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $documentAudioVisuels = DocumentAudioVisuel::all();
        return view('documentAudioVisuel.index')->with('documentAudioVisuels', $documentAudioVisuels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('documentAudioVisuel.create');
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
        $documentAudioVisuel = DocumentAudioVisuel::create([
            'genre' => $request->genre,
            'ISAN' => $request->ISAN
        ]);
        return redirect()->route('documentAudioVisuel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentAudioVisuel $documentAudioVisuel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentAudioVisuel $documentAudioVisuel)
    {
        //
        return view('documentAudioVisuel.edit')->with('documentAudioVisuel', $documentAudioVisuel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentAudioVisuel $documentAudioVisuel)
    {
        //
        $documentAudioVisuel->update(array([
            'genre' => $request['genre'],
            'ISAN' => $request['ISAN']
        ]));
        return redirect()->route('documentAudioVisuel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentAudioVisuel  $documentAudioVisuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentAudioVisuel $documentAudioVisuel)
    {
        //
        $documentAudioVisuel->delete();
        return redirect()->route('documentAudioVisuel.index');
    }
}
