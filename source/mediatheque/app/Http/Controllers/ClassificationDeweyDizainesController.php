<?php

namespace App\Http\Controllers;

use App\Models\ClassificationDeweyDizaine;
use Illuminate\Http\Request;

class ClassificationDeweyDizainesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classificationDeweyDizaines = ClassificationDeweyDizaine::all();
        return view('classificationDeweyDizaines.index')->with('classificationDeweyDizaines', $classificationDeweyDizaines);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('classificationDeweyDizaines.create');
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
        $classificationDeweyDizaines = ClassificationDeweyDizaine::create([
            'classe' => $request->classe,
            'matiere' => $request->matiere
        ]);
        return redirect()->route('classificationDeweyDizaines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassificationDeweyDizaine  $classificationDeweyDizaines
     * @return \Illuminate\Http\Response
     */
    public function show(ClassificationDeweyDizaine $classificationDeweyDizaines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassificationDeweyDizaine  $classificationDeweyDizaines
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassificationDeweyDizaine $classificationDeweyDizaines)
    {
        //
        return view('classificationDeweyDizaines.edit')->with('classificationDeweyDizaines', $classificationDeweyDizaines);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassificationDeweyDizaine  $classificationDeweyDizaines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassificationDeweyDizaine $classificationDeweyDizaines)
    {
        //
        $classificationDeweyDizaines->update(array([
            'classe' => $request['classe'],
            'matiere' => $request['matiere']
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassificationDeweyDizaine  $classificationDeweyDizaines
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassificationDeweyDizaine $classificationDeweyDizaines)
    {
        //
        $classificationDeweyDizaines->delete();
        return redirect()->route('classificationDeweyDizaines.index');
    }
}
