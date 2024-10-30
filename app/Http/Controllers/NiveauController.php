<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $niveaux = Niveau::when($request->has('search'), function ($query) use ($request) {
            return $query->where('libelle', 'like', '%' . $request->input('search') . '%');
        })->paginate(10);
        
        return view('niveaux.index', compact('niveaux'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('niveaux.create_or_edit');
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
            'libelle' => 'required|unique:niveaux',
        ]);
        
        $niveau = Niveau::create($validated_data);

        return redirect()->route('niveaux.index')->with("success", "Le Niveau $niveau->libelle à été créer avec success !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function show(Niveau $niveau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function edit(Niveau $niveau)
    {
        return view('niveaux.create_or_edit', compact('niveau'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveau $niveau)
    {
        $validated_data = $request->validate([
            'libelle' => 'required',
            Rule::unique('niveaux')->ignore($niveau->id),
        ]);
        
        $niveau->update($validated_data);

        return redirect()->route('niveaux.index')->with("success", "La Niveau $niveau->libelle à été mis à jour avec success !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Niveau $niveau)
    {
        $ouvrages = $niveau->ouvrages;
        if ($ouvrages->count() > 0) {
            return redirect()->route('niveaux.index')->with("error", "Le niveau $niveau->libelle ne peut pas être supprimer car il est relier à certain ouvrages !");
        }
        
        $niveau->delete();
        return redirect()->route('niveaux.index')->with("success", "Le niveau $niveau->libelle à été bien supprimer !");
    }
}
