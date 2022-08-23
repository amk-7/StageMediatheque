<?php

namespace App\Http\Controllers;

use App\Models\ClassificationDeweyCentaine;
use Illuminate\Http\Request;

class ClassificationDeweyCentaineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classificationDeweyCentaines = ClassificationDeweyCentaine::all();
        return view('classificationDeweyCentaine.index')->with('classificationDeweyCentaines', $classificationDeweyCentaines);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('classificationDeweyCentaine.create');
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
        $classificationDeweyCentaine = ClassificationDeweyCentaine::create([
            'section' => $request->section,
            'theme' => $request->theme
        ]);
        return redirect()->route('classificationDeweyCentaine.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassificationDeweyCentaine  $classificationDeweyCentaine
     * @return \Illuminate\Http\Response
     */
    public function show(ClassificationDeweyCentaine $classificationDeweyCentaine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassificationDeweyCentaine  $classificationDeweyCentaine
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassificationDeweyCentaine $classificationDeweyCentaine)
    {
        //
        return view('classificationDeweyCentaine.edit')->with('classificationDeweyCentaine', $classificationDeweyCentaine);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassificationDeweyCentaine  $classificationDeweyCentaine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassificationDeweyCentaine $classificationDeweyCentaine)
    {
        //
        $classificationDeweyCentaine->update(array([
            'section' => $request['section'],
            'theme' => $request['theme']
        ]));
        return redirect()->route('classificationDeweyCentaine.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassificationDeweyCentaine  $classificationDeweyCentaine
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassificationDeweyCentaine $classificationDeweyCentaine)
    {
        //
        $classificationDeweyCentaine->delete();
        return redirect()->route('classificationDeweyCentaine.index');
    }
}
