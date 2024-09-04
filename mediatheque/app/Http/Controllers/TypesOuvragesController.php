<?php

namespace App\Http\Controllers;

use App\Models\TypesOuvrage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypesOuvragesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types_ouvrages = TypesOuvrage::when($request->has('search'), function ($query) use ($request) {
            return $query->where('libelle', 'like', '%' . $request->input('search') . '%');
        })->paginate(10);
        
        return view('types_ouvrages.index', compact('types_ouvrages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types_ouvrages.create_or_edit');
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
            'libelle' => 'required|unique:types_ouvrages',
        ]);
        
        $typesOuvrages = TypesOuvrage::create($validated_data);

        return redirect()->route('types_ouvrages.index')->with("success", "Le TypesOuvrage $typesOuvrages->libelle à été créer avec success !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypesOuvrage  $typesOuvrages
     * @return \Illuminate\Http\Response
     */
    public function show(TypesOuvrage $typesOuvrages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypesOuvrage  $typesOuvrages
     * @return \Illuminate\Http\Response
     */
    public function edit(TypesOuvrage $types_ouvrage)
    {
        return view('types_ouvrages.create_or_edit', compact('types_ouvrage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypesOuvrage  $typesOuvrages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypesOuvrage $typesOuvrages)
    {
        $validated_data = $request->validate([
            'libelle' => 'required',
            Rule::unique('TypesOuvrages')->ignore($typesOuvrages->id),
        ]);
        
        $typesOuvrages->update($validated_data);

        return redirect()->route('types_ouvrages.index')->with("success", "Le TypesOuvrage $typesOuvrages->libelle à été mis à jour avec success !");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypesOuvrage  $typesOuvrages
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypesOuvrage $types_ouvrage)
    {
        $ouvrages = $types_ouvrage->ouvrages;

        if ($ouvrages->count() > 0) {
            return redirect()->route('types_ouvrages.index')->with("error", "Le TypesOuvrage $types_ouvrage->libelle ne peut pas être supprimer car il est relier à certain ouvrages !");
        }
        
        $types_ouvrage->delete();
        return redirect()->route('types_ouvrages.index')->with("success", "Le TypesOuvrage $types_ouvrage->libelle à été bien supprimer !");
    }
}
