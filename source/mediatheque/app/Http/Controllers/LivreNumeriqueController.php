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
        return "livres electronique";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
}
