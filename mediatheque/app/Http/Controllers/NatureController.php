<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;

class NatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $natures = Nature::when($request->has('libelle'), function ($query) use ($request) {
            return $query->where('libelle', 'like', '%' . $request->input('libelle') . '%');
        })->get();

        return view('natures.index', compact('natures'));
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
     * @param  \App\Models\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function show(Nature $nature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function edit(Nature $nature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nature $nature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nature $nature)
    {
        //
    }
}
