<?php

namespace App\Http\Controllers;

use App\Imports\LivresNumeriqueImport;
use App\Imports\LivresPapierImport;
use App\Models\LivresNumerique;
use App\Models\LivresPapier;
use App\Models\Ouvrage;
use App\Models\OuvragesElectronique;
use App\Models\OuvragesPhysique;
use App\Service\AuteurService;
use App\Service\GlobaleService;
use App\Service\LivresNumeriqueService;
use App\Service\LivresPapierService;
use App\Service\OuvragesElectroniqueService;
use App\Service\OuvrageService;
use App\Service\OuvragesPhysiqueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class LivreNumeriqueController extends Controller
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
        $livresNumeriques = LivresNumerique::all();

        return view('livresNumerique.index')->with([
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
            'annees' => $niveausTypesLanguesAuteursAnnee[4],
            'id_livre_numerique'=>LivresNumeriqueService::getAllIDLivreNumerique($livresNumeriques),
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

        return view('livresNumerique.create')->with([
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
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
            'url'=>'required',
        ]);

        // Creation d'un ou des auteurs .
        $data_auteurs = GlobaleService::extractLineToData($request->data_auteurs);
        $auteurs = AuteurService::enregistrerAuteur($data_auteurs);
        // Creation de l'ouvrage
        $ouvrage = OuvrageService::enregisterOuvrage($request, $auteurs);
        // Création d'un ouvrage electronique
        $ouvrageElectronique = OuvragesElectroniqueService::enregistrerOuvrageElectronique($ouvrage, $request->url);
        //dd($ouvrageElectronique);
        $categories_data = GlobaleService::extractLineToData($request->data_categorie);
        $categories = [];
        foreach ($categories_data as $categorie_array){
            array_push($categories, $categorie_array[0]);
        }
        //dd($request["ISBN"]);
        LivresNumerique::create([
            'categorie'=>$categories,
            'ISBN'=>strtoupper($request["ISBN"]),
            'id_ouvrage_electronique'=>$ouvrageElectronique->id_ouvrage_electronique,
        ]);
        //dd(LivresNumerique::find(1));
        return redirect()->route('listeLivresNumerique');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(LivresNumerique $livresNumerique)
    {
        return view('livresNumerique.show')->with('livreNumerique', $livresNumerique);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LivresNumerique  $livresNumerique
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(LivresNumerique $livresNumerique)
    {
        $niveausTypesLanguesAuteursAnnee = OuvrageService::getNiveausTypesLanguesAuteursAnnee();
        $categories = LivresPapierService::getCategories();
        return view('livresNumerique.edite')->with([
            "livresNumerique" => $livresNumerique,
            'niveaus'=> $niveausTypesLanguesAuteursAnnee[0],
            'types'=>$niveausTypesLanguesAuteursAnnee[1],
            'langues'=>$niveausTypesLanguesAuteursAnnee[2],
            'auteurs'=>$niveausTypesLanguesAuteursAnnee[3],
            'categories'=>$categories,
            'annees' => $niveausTypesLanguesAuteursAnnee[4],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, LivresNumerique $livresNumerique)
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
        ]);

        $ouvrageElectronique = OuvragesElectronique::all()->where("id_ouvrage_electronique", $livresNumerique->id_ouvrage_electronique)->first();
        OuvragesElectroniqueService::updateOuvrageElectronique($ouvrageElectronique, $request["url"]);
        $ouvrage = $ouvrageElectronique->ouvrage;
        OuvrageService::updateOuvrage($request, $ouvrage);

        return redirect()->route('listeLivresNumerique');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivresNumerique  $livreNumerique
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(LivresNumerique $livresNumerique)
    {
        //dd($livresNumerique);
        $id_ouvrage = OuvragesElectronique::all()->where('id_ouvrage_electronique', $livresNumerique->id_ouvrage_electronique)->first()->id_ouvrage;
        OuvrageService::supprimer_ouvrage($id_ouvrage);
        return redirect()->route('listeLivresNumerique');
    }

    public function readPdf(OuvragesElectronique $ouvragesElectronique)
    {
        return view('livresNumerique.lire', compact('ouvragesElectronique'));
    }

    public function uploadLivresNumeriqueCreate()
    {

        return view('livresNumerique.excel_import');
    }

    public function uploadLivresNumeriqueStore(Request $request)
    {
        //dd("Okay");
        $destination_path = "public/ouvrage_electonique/";
        $path = "";
        if ($request->file("fileList"))
        {
           foreach ($request->file("fileList") as $file){
               //dump($file);
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
           //dd("pk");
        } else {
            return redirect()->route('formulaireImportExcel');
        }

        //dd($request->url);

        Excel::import(new LivresNumeriqueImport(),'public/fichier_excel/'.$path);
        //dd('Okay...');
        return redirect()->route('listeLivresNumerique');
    }
}
