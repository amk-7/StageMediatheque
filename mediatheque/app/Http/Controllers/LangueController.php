<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LangueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $langues = Langue::when($request->has('search'), function ($query) use ($request) {
            return $query->where('libelle', 'like', '%' . $request->input('search') . '%');
        })->paginate(10);

        return view('langues.index', compact('langues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('langues.create_or_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'libelle' => 'required|unique:langues',
        ]);
        
        $langue = Langue::create($validated_data);

        return redirect()->route('langues.index')->with("success", "Le Langue $langue->libelle à été créer avec success !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Langue  $langue
     * @return \Illuminate\Http\Response
     */
    public function show(Langue $langue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Langue  $langue
     * @return \Illuminate\Http\Response
     */
    public function edit(Langue $langue)
    {
        return view('langues.create_or_edit', compact('langue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Langue  $langue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Langue $langue)
    {
        $validated_data = $request->validate([
            'libelle' => 'required',
            Rule::unique('langues')->ignore($langue->id),
        ]);
        
        $langue->update($validated_data);

        return redirect()->route('langues.index')->with("success", "La langue $langue->libelle à été mis à jour avec success !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Langue  $langue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Langue $langue)
    {
        $ouvrages = $langue->ouvrages;
        if ($ouvrages->count() > 0) {
            return redirect()->route('langues.index')->with("error", "Le Langue $langue->libelle ne peut pas être supprimer car il est relier à certain ouvrages !");
        }
        
        $langue->delete();
        return redirect()->route('langues.index')->with("success", "Le Langue $langue->libelle à été bien supprimer !");
    }
}
