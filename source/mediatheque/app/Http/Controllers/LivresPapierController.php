<?php

namespace App\Http\Controllers;

use App\Helpers\LivrePapierHelper;
use App\Helpers\OuvragePhysiqueHelper;
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
        $livresPapier = LivresPapier::all();
        return view('livresPapier.index')->with('livresPapier', $livresPapier)->paginate(25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveaus = [
            '1er degré', '2è degré', '3è degré', 'université'
        ];

        $types = [
            'roman', 'manuel scolaire', 'document technique', 'document pédagogique', 'bande dessinée', 'journeaux', 'nouvelle'
        ];

        $langues = [
            'français', 'anglais', 'allemend'
        ];

        $categories = [
            'français', 'anglais', 'allemand', 'physique', 'education',
            'hydrolique', 'musique et art', 'théologie', 'philosophie', 'zoologie', 'géologie', 'mathématique générale',
            'bibliographie', 'physique', 'médécine', 'comptabilité', 'droit'
        ];

        $classification_dewey_centaines = ClassificationDeweyCentaine::all();

        $classification_dewey_dizaines = ClassificationDeweyDizaines::all();

        return view('livresPapier.create')->with([
            'niveaus'=> $niveaus,
            'types'=>$types,
            'langues'=>$langues,
            'categories'=>$categories,
            'classification_dewey_centaines'=>$classification_dewey_centaines,
            'classification_dewey_dizaines'=>$classification_dewey_dizaines
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (LivrePapierHelper::ouvrageExist($request["ISBN"])){
            return "Ouvrage existant";
        }
        //dd($request["titre"]);
        $auteur = Auteur::create([
            'nom'=>$request["nom"],
            'prenom'=>$request["prenom"],
            'date_naissance'=> $request["date_naissance"],
            'date_decces'=>$request["date_decces"]
        ]);
        //dd($auteur);
        // Récupérer l'image.
        $image = $request->file('image_livre');
        // Stocker l'image
        $chemin_image = $image->storeAs('images_livre', $request->titre.'.'.$image->extension());

        //dd($request["titre"]);
        $ouvrage = Ouvrage::create([
            'titre'=>$request["titre"],
            'niveau' => $request["niveau"],
            'type'=>$request["type"],
            'image' => "",
            'langue'=>$request["langue"]
        ]);

        //dd($ouvrage);
        $ouvrage->auteur()->attach($auteur->id_auteur, [
            'annee_apparution'=>$request["annee_apparution"],
            'lieu_edition'=>$request["lieu_edition"],
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        $classificationCentaine = ClassificationDeweyCentaine::all()->where("theme", $request["theme"]);
        $classificationDizaine = ClassificationDeweyDizaines::all()->where("id_classification_dewey_centaine", $classificationCentaine->id_classification_dewey_centaine);

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

        return redirect()->route("livresPapier.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function show(LivresPapier $livrePapier)
    {
        return view('livresPapier.show')->with("livrePapier", $livrePapier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function edit(LivresPapier $livrePapier)
    {
        return view('livresPapier.edite')->with("livrePapier", $livrePapier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LivresPapier $livrePapier)
    {
        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $livrePapier->id_ouvrage_physique);
        OuvragePhysiqueHelper::updateOuvrage($ouvragePhysique, $request["nombre_exemplaire"], $request["etat"], $request["disponibilite"]);

        return redirect()->route("livresPapier.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function destroy(LivresPapier $livresPapier)
    {
        $livresPapier->delete();
    }
}
