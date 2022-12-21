<?php

namespace App\Http\Controllers;

use App\Imports\LivresPapierImport;
use App\Models\LivresPapier;
use App\Service\AuteurService;
use App\Service\GlobaleService;
use App\Service\LivresPapierService;
use App\Service\OuvrageService;
use App\Service\OuvragesPhysiqueService;
use App\Models\OuvragesPhysique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LivresPapierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $niveausTypesLanguesAuteursAnnee = OuvrageService::getNiveausTypesLanguesAuteursAnnee();
        $categories = LivresPapierService::getCategories();
        $livresPapiers = LivresPapier::all();

        return view('livresPapier.index')->with([
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
            'annees' => $niveausTypesLanguesAuteursAnnee[4],
            'id_livre_papier'=>LivresPapierService::getAllIDLivrePapier($livresPapiers)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        $niveausTypesLanguesAuteursAnnee = OuvrageService::getNiveausTypesLanguesAuteursAnnee();
        $categories = LivresPapierService::getCategories();
        $classifications_dewey = OuvragesPhysiqueService::getClassificationsDewey();

        return view('livresPapier.create')->with([
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
            'classification_dewey_dizaines'=> $classifications_dewey[1],
            'classification_dewey_centaines'=> $classifications_dewey[0],
            'annees' => $niveausTypesLanguesAuteursAnnee[4],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'ISBN'=>['required',
                function ($attribute, $value, $flail){
                    if (LivresPapierService::exist($value)!=null){
                        $flail("L' ".$attribute." existe déjà");
                    }
                }
            ],
        ])->validate();

        $request->validate([
            'titre'=> 'required',
            'niveau'=>'required|not_in:Sélectionner niveau',
            'type'=>'required|not_in:Sélectionner type',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'data_auteurs'=>'required',
            'data_categorie'=>'required',
            'resume'=>'required',
            'nombre_exemplaire'=>'required',
            'id_classification_dewey_centaine'=>'required|not_in:Sélectionner rayon',
            'id_classification_dewey_dizaine'=>'required|not_in:Sélectionner étagère',
        ]);


        $data_auteurs = GlobaleService::extractLineToData($request->data_auteurs);
        $auteurs = AuteurService::enregistrerAuteur($data_auteurs);

        $ouvrage = OuvrageService::enregisterOuvrage($request, $auteurs);

        $ouvragePhysique = OuvragesPhysiqueService::enregisterOuvragePhysique($request, $ouvrage);

        $categories_data = GlobaleService::extractLineToData($request->data_categorie);
        $categories = [];
        foreach ($categories_data as $categorie_array){
            array_push($categories, $categorie_array[0]);
        }

        LivresPapier::create([
            'categorie'=>$categories,
            'ISBN'=>strtoupper($request["ISBN"]),
            'id_ouvrage_physique'=>$ouvragePhysique->id_ouvrage_physique
        ]);

        return redirect()->route("listeLivresPapier");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(LivresPapier $livresPapier)
    {
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
        $niveausTypesLanguesAuteursAnnee = OuvrageService::getNiveausTypesLanguesAuteursAnnee();
        $categories = LivresPapierService::getCategories();
        $classifications_dewey = OuvragesPhysiqueService::getClassificationsDewey();


        return view('livresPapier.edite')->with([
            "livresPapier" => $livresPapier,
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
            'classification_dewey_centaines'=>$classifications_dewey[0],
            'classification_dewey_dizaines'=>$classifications_dewey[1],
            'annees' => $niveausTypesLanguesAuteursAnnee[4],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, LivresPapier $livresPapier)
    {

        $request->validate([
            'titre'=> 'required',
            'niveau'=>'required|not_in:Sélectionner niveau',
            'type'=>'required|not_in:Sélectionner type',
            'annee_apparution'=>'required',
            'lieu_edition'=>'required',
            'data_auteurs'=>'required',
            'data_categorie'=>'required',
            'resume'=>'required',
            'nombre_exemplaire'=>'required',
            'id_classification_dewey_centaine'=>'required|not_in:Sélectionner rayon',
            'id_classification_dewey_dizaine'=>'required|not_in:Sélectionner étagère',
        ]);

        $ouvragePhysique = OuvragesPhysique::all()->where("id_ouvrage_physique", $livresPapier->id_ouvrage_physique)->first();
        OuvragesPhysiqueService::updateOuvrage($ouvragePhysique, $request["nombre_exemplaire"]);
        OuvrageService::updateOuvrage($request, $ouvragePhysique);

        return redirect()->route('listeLivresPapier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivresPapier  $livresPapier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(LivresPapier $livresPapier)
    {
        $id_ouvrage = OuvragesPhysique::all()->where('id_ouvrage_physique', $livresPapier->id_ouvrage_physique)->first()->id_ouvrage;
        OuvrageService::supprimer_ouvrage($id_ouvrage);
        return redirect()->route('listeLivresPapier');
    }

    public function uploadLivresPapierCreate()
    {

       return view('livresPapier.excel_import');
    }

    public function uploadLivresPapierStore(Request $request)
    {
        /*$destination_path = "public/images/images_livre";
        $path = "";
        if ($request->file("fileList"))
        {
            foreach ($request->file("fileList") as $file){
                if ($file->isReadable()){
                    if (! in_array($file->extension(), ["xlsx", "odt"])){
                        $file->storeAs($destination_path, $file->getClientOriginalName());
                    } else {
                        $destination_path = "public/fichier_excel/";
                        $path = $file->getClientOriginalName();
                        $file->storeAs("$destination_path", $path);
                    }
                }
            }
        } else {
            return redirect()->route('formulaireImportExcel');
        }*/
        if (! $request->url == null)
        {
            $chemin_ouvrage_excel = strtolower('livres_papier').'.'.$request->url->extension();
            $request->url->storeAs('public/fichier_excel/', $chemin_ouvrage_excel);
        } else
        {
            return redirect()->back()->withErrors(['url' => "Vous n'avez pas séléctionner de fichier excele"]);
        }

        \Session(["error_id" => 0]);
        \Session(["compteur" => 0]);

        Excel::import(new LivresPapierImport,'public/fichier_excel/'.$chemin_ouvrage_excel);

        if (session('error_id') > 0){
            return redirect()->back()->withInput()->withErrors(['url' => "Le fichier excel n'est pas intégre. Une erreur est survenue à la ligne ".session('error_id')]);
        }

        return redirect()->route('listeLivresPapier');
    }

    public function downloadCoteQrcode(LivresPapier $livresPapier)
    {
        $cote_qrcode = base64_encode(QrCode::format('png')->generate($livresPapier->ouvragesPhysique->cote));

        return "<image src='data:image/png;base64, $cote_qrcode'/>";
    }
}

