<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use Carbon\Carbon;
use App\Models\OuvragesPhysique;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaines;
use Illuminate\Http\Request;

class LivresPapierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livresPapier.create');
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
        $auteur = Auteur::create([
            'nom'=>$request["nom"],
            'prenom'=>$request["prenom"],
            'titre'=>$request["titre"],
            'date_naissance'=> $request["date_naissance"],
            'date_decces'=>$request["date_decces"]
        ]);
        $image = $request->file('avatar');
        $chemin_image = $image->storeAs('profils', $request->nomUtilisateur.'.'.$image->extension());
        $ouvrage = Ouvrage::create([
            'niveau' => $request["niveau"],
            'type'=>$request["type"],
            'image' => $chemin_image,
            'langue'=>$request["langue"]
        ]);

        $ouvrage->auteur()->attach($auteur->id_auteur, [
            'date_apparution'=>$request["date_apparution"],
            'lieu_edition'=>$request["lieu_edition"],
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        $classificationCentaine = ClassificationDeweyCentaine::create([
            'section'=>$request["section"],
            'theme'=>$request["theme"]
        ]);
        
        $classificationDizaine = ClassificationDeweyDizaines::create([
            'classe'=>$request["classe"],
            'matiere'=>$request["matiere"],
            'id_classification_dewey_centaine'=>$classificationCentaine->id_classification_dewey_centaine
        ]);

        $ouvragePhysique = OuvragesPhysique::Create([
            'nombre_exemplaire' => $request["nombre_exemplaire"],
            'etat'=>$request["etat"],
            'disponibilite'=>true,
            'id_ouvrage'=>$ouvrage->id_ouvrage,
            'id_classification_dewey_dizaines'=>$classificationDizaine->id_classification_dewey_dizaines
        ]);

        $livresPapier = LivresPapier::create([
            'catetegorie'=>$request["catetegorie"],
            'ISBN'=>$request["ISBN"],
            'id_ouvrage_physique'=>$ouvragePhysique->id_ouvrage_physique
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function show(LivresPapier $livresPapier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function edit(LivresPapier $livresPapier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LivresPapier $livresPapier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function destroy(LivresPapier $livresPapier)
    {
        //
    }
}
