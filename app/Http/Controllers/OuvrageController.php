<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ouvrage;
use App\Models\TypesOuvrage;
use App\Models\Langue;
use App\Models\Domaine;
use App\Models\Niveau;
use App\Models\Auteur;
use App\Imports\OuvragesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Exports\OuvragesExport;
use App\Jobs\OuvrageImportJob;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;
use Exception;

class OuvrageController extends Controller
{
    use DispatchesJobs;

    public function welcome(Request $request)
    {
        try {
            $selected_search = $request->input('search');
            $selected_min = $request->input('min');
            $selected_max = $request->input('max');
            $selected_langue = $request->input('langue');
            $selected_type = $request->input('type');
            $selected_domaine = $request->input('domaine');
            $selected_niveau = $request->input('niveau');

            $filters = [
                'search' => $selected_search,
                'min' => $selected_min,
                'max' => $selected_max,
                'langue' => $selected_langue,
                'type' => $selected_type,
                'domaine' => $selected_domaine,
                'niveau' => $selected_niveau,
            ];

            $ouvrages = Ouvrage::filter($filters)
                                ->addSelect([
                                    'type' => TypesOuvrage::select('libelle')
                                                            ->whereColumn('types_ouvrages.id_type_ouvrage', 'ouvrages.id_type')
                                                            ->take(1)
                                ])
                                ->orderBy('titre', 'asc')
                                ->get();

            $annees = Ouvrage::where('annee_apparution', '<>', null)->distinct()->orderBy('annee_apparution', 'asc')->pluck('annee_apparution');

            return view('welcome')->with([
                'ouvrages' => $ouvrages,
                'annees' => $annees,
                'langues' => Langue::has('ouvrages')->get(),
                'types' => TypesOuvrage::has('ouvrages')->get(),
                'categories' => Domaine::has('ouvrages')->get(),
                'niveaus' => Niveau::has('ouvrages')->get(),
                'selected_search' => $selected_search,
                'selected_min' => $selected_min,
                'selected_max' => $selected_max,
                'selected_langue' => $selected_langue,
                'selected_type' => $selected_type,
                'selected_domaine' => $selected_domaine,
                'selected_niveau' => $selected_niveau,
            ]);
        } catch (Exception $e) {
            abort(500, 'Une erreur est survenue lors du chargement des ouvrages.');
        }
    }

    public function index(Request $request)
    {
        try {
            $selected_search = $request->input('search');
            $selected_min = $request->input('min');
            $selected_max = $request->input('max');
            $selected_langue = $request->input('langue');
            $selected_type = $request->input('type');
            $selected_domaine = $request->input('domaine');
            $selected_niveau = $request->input('niveau');

            $filters = [
                'search' => $selected_search,
                'min' => $selected_min,
                'max' => $selected_max,
                'langue' => $selected_langue,
                'type' => $selected_type,
                'domaine' => $selected_domaine,
                'niveau' => $selected_niveau,
            ];

            $nb_ouvrage = Ouvrage::count();
            $ouvrages = Ouvrage::filter($filters)
                                ->with(['langues'])
                                ->addSelect([
                                    'type' => TypesOuvrage::select('libelle')
                                    ->whereColumn('types_ouvrages.id_type_ouvrage', 'ouvrages.id_type')
                                    ->take(1),
                                ])
                                ->orderBy('annee_apparution', 'asc')
                                ->paginate(10);

            $annees = Ouvrage::where('annee_apparution', '<>', null)->distinct()->orderBy('annee_apparution', 'asc')->pluck('annee_apparution');

            return view('ouvrages.index')->with([
                'ouvrages' => $ouvrages,
                'nb_ouvrage' => $nb_ouvrage,
                'annees' => $annees,
                'langues' => Langue::has('ouvrages')->get(),
                'types' => TypesOuvrage::has('ouvrages')->get(),
                'categories' => Domaine::has('ouvrages')->get(),
                'niveaus' => Niveau::has('ouvrages')->get(),
                'selected_search' => $selected_search,
                'selected_min' => $selected_min,
                'selected_max' => $selected_max,
                'selected_langue' => $selected_langue,
                'selected_type' => $selected_type,
                'selected_domaine' => $selected_domaine,
                'selected_niveau' => $selected_niveau,
            ]);
        } catch (Exception $e) {
            abort(500, 'Une erreur est survenue lors de la récupération des ouvrages.');
        }
    }

    public function indexArchive()
    {
        try {
            $archives = Ouvrage::onlyTrashed()->get();
            return view('ouvrages.archive', compact('archives'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la récupération des archives.');
        }
    }

    // Imprimer la cote d'un ouvrage spécifique
    public function imprimerCote($id)
    {
        try {
            $ouvrage = Ouvrage::findOrFail($id);
            $pdf = \PDF::loadView('ouvrages.cote', compact('ouvrage'));
            return $pdf->download("cote_ouvrage_{$id}.pdf");
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la génération de la cote.');
        }
    }

    public function create()
    {
        try {
            $types = TypesOuvrage::all();
            $niveaux = Niveau::all();
            $langues = Langue::all();
            $domaines = Domaine::all();
            $auteurs = Auteur::all();
            $ouvrage = new Ouvrage();
            // $ouvrage->id_ouvrage =null;
            return view('ouvrages.create', compact('types', 'niveaux', 'langues', 'domaines', 'auteurs', 'ouvrage'));
        } catch (Exception $e) {
            abort(500, 'Une erreur est survenue lors du chargement du formulaire de création.');

        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|unique:ouvrages',
            'niveau' => 'required|not_in:Sélectionner niveau',
            'type' => 'required|not_in:Sélectionner type',
            'langues' => 'required',
            'annee_apparution' => 'required',
            'lieu_edition' => 'required',
            'data_auteurs' => 'required',
            'domaines' => 'required',
            'nombre_exemplaire' => 'numeric|min:1',
        ]);

        try {

            $mots_cle_data = Controller::extractLineToData($request->data_mots_cle);
            $mots_cle = [];
            foreach ($mots_cle_data as $mot_cle_array) {
                if (! empty($mot_cle_array[0])){
                    array_push($mots_cle, $mot_cle_array[0]);
                }
            }

            $image = $request->file('image_livre');
            $id = Ouvrage::max("id_ouvrage")+1;
            if ($image != null) {
                $chemin_image = "books/covers/livre_" . $id . '.' . $image->extension();
                $image->storeAs('public/', $chemin_image);
            } else {
                $chemin_image = "books/covers/livre_logo.jpeg";
            }

            $destination_path = "books/pdf/";
            $chemin_ouvrage_excel = null;
            if ($request->file("document") || $request->document != null) {
                $chemin_ouvrage_excel = "livre_".strtolower($id) . '.' . $request->document->extension();
                $request->document->storeAs("public/" . $destination_path, $chemin_ouvrage_excel);
            }

            $ouvrage = Ouvrage::create([
                'titre' => strtolower($request->input("titre")),
                'id_niveau' => $request->input("niveau"),
                'id_type' => $request->input("type"),
                'image' => $chemin_image,
                'id_langue' => $request->input("langue"),
                'resume' => $request->input("resume"),
                'mot_cle' => $mots_cle,
                'annee_apparution' => $request->input('annee_apparution'),
                'lieu_edition' => $request->input('lieu_edition'),
                'nombre_exemplaire' => $request->input('nombre_exemplaire'),
                'ressources_externe' => $request['ressources_externe'],
                'cote' => md5($id),
                'documents' => $chemin_ouvrage_excel,
                'isbn' => $request->input("isbn"),
            ]);

            $ouvrage->retirerLangues($request->langues);
            $ouvrage->ajouterLangues($request->langues);

            $ouvrage->retirerDomaines($request->domaines);
            $ouvrage->ajouterDomaines($request->domaines);

            $data_auteurs = Controller::extractLineToData($request->data_auteurs);
            $auteurs = Auteur::enregistrerAuteur($data_auteurs);
            $ouvrage->retirerAuteurs();
            $ouvrage->ajouterAuteurs($auteurs);

            return redirect()->route('ouvrages.index')->with('success', 'Ouvrage créé avec succès.');
        } catch (Exception $e) {
            abort(500, 'Une erreur est survenue lors de la création de l\'ouvrage.');
        }
    }
    public function show($id)
    {
        try {
            $ouvrage = Ouvrage::with(['langues', 'domaines', 'auteurs'])->findOrFail($id);
            return view('ouvrages.show', compact('ouvrage'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la récupération de l\'ouvrage.');
        }
    }

    public function edit($id)
    {
        try {
            $ouvrage = Ouvrage::findOrFail($id);
            $types = TypesOuvrage::all();
            $niveaux = Niveau::all();
            $langues = Langue::all();
            $domaines = Domaine::all();
            return view('ouvrages.edit', compact('ouvrage', 'types', 'niveaux', 'langues', 'domaines'));
        } catch (Exception $e) {
            abort(500, 'Une erreur est survenue lors du chargement du formulaire de modification.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ouvrage = Ouvrage::findOrFail($id);

            $request->validate([
                'titre' => 'required|unique:ouvrages,titre,' . $id,
                'niveau' => 'required|not_in:Sélectionner niveau',
                'type' => 'required|not_in:Sélectionner type',
                'langues' => 'required',
                'annee_apparution' => 'required',
                'lieu_edition' => 'required',
                'data_auteurs' => 'required',
                'domaines' => 'required',
                'nombre_exemplaire' => 'numeric|min:1',
            ]);

            // Mise à jour des informations de l'ouvrage
            $ouvrage->update($request->all());
            $ouvrage->retirerLangues($request->langues);
            $ouvrage->ajouterLangues($request->langues);

            $ouvrage->retirerDomaines($request->domaines);
            $ouvrage->ajouterDomaines($request->domaines);

            $data_auteurs = Controller::extractLineToData($request->data_auteurs);
            $auteurs = Auteur::enregistrerAuteur($data_auteurs);
            $ouvrage->retirerAuteurs();
            $ouvrage->ajouterAuteurs($auteurs);

            return redirect()->route('ouvrages.index')->with('success', 'Ouvrage mis à jour avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de l\'ouvrage.');
        }
    }

    public function destroy($id)
    {
        try {
            $ouvrage = Ouvrage::findOrFail($id);
            $ouvrage->delete();
            return redirect()->route('ouvrages.index')->with('success', 'Ouvrage supprimé avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de l\'ouvrage.');
        }
    }

    public function readPdf($id)
    {
        try {
            $ouvrage = Ouvrage::findOrFail($id);
            $path = storage_path("app/public/ouvrages/{$ouvrage->pdf_file}");
            if (file_exists($path)) {
                return response()->file($path);
            } else {
                return redirect()->back()->with('error', 'Fichier PDF introuvable.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la lecture du PDF.');
        }
    }

    public function uploadLivresPapierView()
    {
        try {
            return view('ouvrages.upload_livres_papier');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors du chargement de la vue d\'upload.');
        }
    }


    public function importExcel(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,csv'
            ]);

            $file = $request->file('file');
            $importJob = new OuvrageImportJob($file->getRealPath());
            $this->dispatch($importJob);

            return redirect()->back()->with('success', 'Importation en cours. Vous serez notifié à la fin du processus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'importation du fichier.');
        }
    }

    public function exportExcel()
    {
        try {
            return Excel::download(new OuvragesExport, 'ouvrages.xlsx');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'exportation des ouvrages.');
        }
    }

}
