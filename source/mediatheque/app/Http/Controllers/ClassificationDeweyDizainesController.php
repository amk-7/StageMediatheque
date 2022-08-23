<?php

namespace App\Http\Controllers;

use App\Models\ClassificationDeweyDizaines;
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
        $classificationDeweyDizaines = ClassificationDeweyDizaines::all();
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
        $classificationDeweyDizaines = ClassificationDeweyDizaines::create([
            'classe' => $request->classe,
            'matiere' => $request->matiere
        ]);
        return redirect()->route('classificationDeweyDizaines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassificationDeweyDizaines  $classificationDeweyDizaines
     * @return \Illuminate\Http\Response
     */
    public function show(ClassificationDeweyDizaines $classificationDeweyDizaines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassificationDeweyDizaines  $classificationDeweyDizaines
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassificationDeweyDizaines $classificationDeweyDizaines)
    {
        //
        return view('classificationDeweyDizaines.edit')->with('classificationDeweyDizaines', $classificationDeweyDizaines);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassificationDeweyDizaines  $classificationDeweyDizaines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassificationDeweyDizaines $classificationDeweyDizaines)
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
     * @param  \App\Models\ClassificationDeweyDizaines  $classificationDeweyDizaines
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassificationDeweyDizaines $classificationDeweyDizaines)
    {
        //
        $classificationDeweyDizaines->delete();
        return redirect()->route('classificationDeweyDizaines.index');
    }
}
