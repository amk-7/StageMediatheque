<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $domaines = Domaine::when($request->has('search'), function ($query) use ($request) {
            return $query->where('libelle', 'like', '%' . $request->input('search') . '%');
        })->paginate(10);

        return view('domaines.index', compact('domaines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domaines.create_or_edit');
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
            'libelle' => 'required|unique:domaines',
        ]);
        
        $domaine = Domaine::create($validated_data);

        return redirect()->route('domaines.index')->with("success", "Le domaine $domaine->libelle à été créer avec success !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domaine  $domaine
     * @return \Illuminate\Http\Response
     */
    public function show(Domaine $domaine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domaine  $domaine
     * @return \Illuminate\Http\Response
     */
    public function edit(Domaine $domaine)
    {
        return view('domaines.create_or_edit', compact('domaine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domaine  $domaine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domaine $domaine)
    {
        $validated_data = $request->validate([
            'libelle' => 'required',
            Rule::unique('domaines')->ignore($domaine->id),
        ]);
        
        $domaine->update($validated_data);

        return redirect()->route('domaines.index')->with("success", "Le domaine $domaine->libelle à été mis à jour avec success !");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domaine  $domaine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domaine $domaine)
    {
        $ouvrages = $domaine->ouvrages;

        if ($ouvrages->count() > 0) {
            return redirect()->route('domaines.index')->with("error", "Le domaine $domaine->libelle ne peut pas être supprimer car il est relier à certain ouvrages !");
        }
        
        $domaine->delete();
        return redirect()->route('domaines.index')->with("success", "Le domaine $domaine->libelle à été bien supprimer !");
    }
}
