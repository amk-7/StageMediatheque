<?php

namespace App\Http\Controllers;

use App\Helpers\AuteurHelpers;
use App\Helpers\LivrePapierHelper;
use App\Helpers\OuvrageHelper;
use App\Helpers\OuvragePhysiqueHelper;
use App\Models\Auteur;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use Carbon\Carbon;
use App\Models\OuvragesPhysique;
use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaine;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Ramsey\Uuid\Type\Integer;

class LivresPapierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd( ClassificationDeweyCentaine::all()->first()->classificationDeweyDizaines);
        $livresPapier = LivresPapier::paginate(5);
        return view('livresPapier.index')->with('livresPapiers', $livresPapier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveausTypesLangues = OuvrageHelper::getNiveausTypesLangues();
        $categories = LivrePapierHelper::getCategories();
        $classifications_dewey = OuvragePhysiqueHelper::getClassificationsDewey();

        return view('livresPapier.create')->with([
            'niveaus'=> $niveausTypesLangues[0],
            'types'=>$niveausTypesLangues[1],
            'langues'=>$niveausTypesLangues[2],
            'categories'=>$categories,
            'classification_dewey_centaines'=>$classifications_dewey[0],
            'classification_dewey_dizaines'=>$classifications_dewey[1]
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
        //Verifier si les champs par défaut d'un auteur sont remplie.

        //dd($request);
        $request->validate([
            'titre'=> 'required',
            'niveau'=>'required|not_in:--Selectionner--',
            'type'=>'required|not_in:--Selectionner--',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'auteur0'=>'required',
            'categorie0'=>'required|not_in:--Selectionner--',
            'ISBN'=>'required',
            'resume'=>'required',
            'nombre_exemplaire'=>'required',
            'etat'=>'required',
            'id_classification_dewey_centaine'=>'required|not_in:--Selectionner--',
            'id_classification_dewey_dizaine'=>'required|not_in:--Selectionner--',

        ]);

        $livres_papier = LivrePapierHelper::livrePapierExist($request["ISBN"], $request["titre"], (Integer) $request["annee_apparution"]);

        if ($livres_papier!=null){
            return redirect()->route("formulaireModificationLivrePapier", compact("livres_papier"));
        }

        // Creation d'un ou des auteurs .
        $auteurs = AuteurHelpers::enregistrerAuteur($request);
        // Creation de l'ouvrage
        $ouvrage = OuvrageHelper::enregisterOuvrage($request, $auteurs);
        // Création d'un ouvrage physique
        $ouvragePhysique = OuvragePhysiqueHelper::enregisterOuvragePhysique($request, $ouvrage);
        //dd($ouvragePhysique);
        $list_categories = OuvrageHelper::convertDataToArray($request, "categorie");
        //dd($list_categories);
        $categories = OuvrageHelper::convertObjetToArray($list_categories, "categorie");
        //dd($categories);
        LivresPapier::create([
           'categorie'=>$categories,
           'ISBN'=>$request["ISBN"],
           'id_ouvrage_physique'=>$ouvragePhysique->id_ouvrage_physique
       ]);
        return redirect()->route("listeLivresPapier");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function show(LivresPapier $livresPapier)
    {
        //ddd($livresPapier->id_livre_papier);
        return view('livresPapier.show')->with("livrePapier", $livresPapier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(LivresPapier $livresPapier)
    {
        //dd($livresPapier);
        $niveausTypesLangues = OuvrageHelper::getNiveausTypesLangues();
        $categories = LivrePapierHelper::getCategories();
        $classifications_dewey = OuvragePhysiqueHelper::getClassificationsDewey();


        return view('livresPapier.edite')->with([
            "livrePapier" => $livresPapier,
            'niveaus'=> $niveausTypesLangues[0],
            'types'=>$niveausTypesLangues[1],
            'langues'=>$niveausTypesLangues[2],
            'categories'=>$categories,
            'classification_dewey_centaines'=>$classifications_dewey[0],
            'classification_dewey_dizaines'=>$classifications_dewey[1]
        ]);
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

        return redirect()->route('listeLivresPapier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\Response
     */
    public function destroy(LivresPapier $livresPapier)
    {
        //$livresPapier->delete();
        //dd("suppression");
        return redirect()->route('listeLivresPapier');
    }

    public function echoclassification_dewey_dizaines(){

        $class_centaines = ClassificationDeweyDizaine::all()->toJson();
        echo json_encode($class_centaines)."|";
        //$class_dizaines = [];
        /*$class_dizaines_str = "";
        for ($i=0; $i<1; $i++){
            //array_push($class_dizaines, $class_centaines[$i]->classificationDeweyDizaines->toArray());
            $class_dewey_dizaines = $class_centaines[$i]->classificationDeweyDizaines;
            $matiers = "";
            / *foreach ($class_dewey_dizaines as $cdd){
                //dd($cdd->matiere);
                $matiers .= $cdd->matiere.",";
            } * /
            //dd($matiers);
            $class_dizaines_str .= "{".$class_centaines[$i]->theme.":[".$matiers."]},";
        }
        $class_dizaines_str .= "{".$class_centaines[1]->theme.":[".$matiers."]}";
        //$class_dizaines_str .= "]";
        //dd(json_encode($class_dizaines));
        echo json_encode($class_dizaines_str)."|";*/
    }
}
