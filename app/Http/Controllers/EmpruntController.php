<?php

namespace App\Http\Controllers;

use App\Exports\EmpruntExport;
use App\Models\Emprunt;
use App\Models\User;
use App\Models\Abonne;
use App\Models\Personnel;
use App\Models\Ouvrage;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMessage;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\MailEmpruntJob;
use App\Models\LignesEmprunt;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;


class EmpruntController extends Controller
{
    use DispatchesJobs;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $paginate = 10;

            $start_date = $request->input('start_date', date('Y-01-01'));
            $end_date = $request->input('end_date', date('Y-m-d'));
            $search = $request->input('search');
            
            $emprunts = Emprunt::whereBetween('date_emprunt', [$start_date, $end_date])
                                                    ->whereHas('abonne', function ($query) use ($search) {
                                                        $query->whereHas('utilisateur', function ($query) use ($search) {
                                                            $query->where("nom", "like", "%".strtoupper($search)."%");
                                                        });
                                                    })->with('restitution')
                                                    ->orderBy('date_emprunt', 'desc')->paginate($paginate);
            
            return view('emprunt.index', compact('emprunts', 'start_date', 'end_date', 'search'));
        } catch (\Throwable $th) {
            abort(500, 'Une erreur est survenue lors du chargement des emprunts.');
        }
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $ouvrages = Ouvrage::select('id_ouvrage', 'titre')->where('nombre_exemplaire', '>', 0)->get();
            $abonnes = Abonne::where('profil_valider', 1)
                            ->whereHas('registrations', function ($query) {
                                $query->where('etat', "1");
                            })
                            ->whereDoesntHave('emprunts', function ($query) {
                                $query->whereNull('date_retour');
                            })->orWhereHas('emprunts', function ($query) {
                                $query->where('date_retour', '<', date('Y-m-d'));
                            })
                            ->join('users', 'abonnes.id_utilisateur', '=', 'users.id_utilisateur')
                            ->select('abonnes.id_abonne', 'users.nom', 'users.prenom')
                            ->get();
                                
            return view('emprunt.create')->with([
                "ouvrages" => $ouvrages,
                "abonnes" => $abonnes,
                "ouvrages_ids" => json_encode([]),
            ]);
        } catch (\Throwable $th) {
            abort(500, 'Une erreur est survenue lors du chargement du formulaire d\'emprunt.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'abonne'=>'required',
            'ouvrages'=>'required',
            'duree_emprunt' => 'required',
        ]);
        
        try {
            $abonne = $request->abonne;
            $duree_emprunt = $request->duree_emprunt;


            $date_retour = Controller::determinerDateRetour($duree_emprunt);

            $emprunt = Emprunt::create([
                'date_emprunt' => date('Y-m-d'),
                'date_retour' => $date_retour,
                'id_abonne' => $abonne,
                'id_personnel' => Personnel::all()->where("id_utilisateur", Auth::user()->id_utilisateur)->first()->id_personnel,
            ]);

            //$etats = Controller::demanderEtat();

            //dd($etats);
            foreach ($request->ouvrages as $ouvrage_id){
                LignesEmprunt::create([
                    'etat_sortie' => 4,
                    'disponibilite' => false,
                    'id_ouvrage' => $ouvrage_id,
                    'id_emprunt' => $emprunt->id_emprunt,
                ]);

                $ouvrage = Ouvrage::firstWhere('id_ouvrage', $ouvrage_id);
                $ouvrage->decrementerNombreExemplaire();
                //$ouvrage->augmenterNombreExemplaire(0);
            }

            //dd($request->all());

            $utilisateur = User::find($abonne);

            $email = $utilisateur->email;

            $date_retour = $emprunt->date_retour;

            $date_emprunt = $emprunt->date_emprunt;

            $duree_emprunt = $duree_emprunt;

            $data = array(
                'user' => $utilisateur->nom_utilisateur,
                'date_retour' => $date_retour->format('d-m-Y'),
                'date_emprunt' => $date_emprunt->format('d-m-Y'),
                'ouvrages' => implode(';', $emprunt->ouvrageEmprunte),
            );

            // $jobMailEmprunt = new MailEmpruntJob($email, $data);
            // //$jobMailEmprunt->delay(Carbon::now()->addSeconds($date_retour->subDays(2)));
            // $jobMailEmprunt->delay(Carbon::now()->addSeconds(5));
            // $this->dispatch($jobMailEmprunt);
            return redirect()->route("emprunts.index");
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Emprunt $emprunt)
    {
        try {
            return view('emprunt.show')->with([
                'emprunt'=>$emprunt,
            ]);
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Emprunt $emprunt)
    {
        try {
            
            $ouvrages = Ouvrage::select('id_ouvrage', 'titre')->where('nombre_exemplaire', '>', 0)->get();
            $abonnes = Abonne::where('profil_valider', 1)
            ->whereHas('registrations', function ($query){
                                $query->where('etat', "1"); })
                            ->join('users', 'abonnes.id_utilisateur', '=', 'users.id_utilisateur')
                            ->select('abonnes.id_abonne', 'users.nom', 'users.prenom')
                            ->get();
                            
            $ouvrages_ids = $emprunt->query()
            ->join('lignes_emprunts', 'emprunts.id_emprunt', '=', 'lignes_emprunts.id_emprunt')
                                    ->join('ouvrages', 'ouvrages.id_ouvrage', '=', 'lignes_emprunts.id_ouvrage')
                                    ->pluck('ouvrages.id_ouvrage');

            $nombreDeSemaines = $emprunt->date_emprunt->diffInWeeks($emprunt->date_retour);

            return view('emprunt.create')->with([
                "ouvrages" => $ouvrages,
                "abonnes" => $abonnes,
                "emprunt" => $emprunt,
                "nombreDeSemaines" => $nombreDeSemaines,
                "ouvrages_ids" => json_encode($ouvrages_ids),
            ]);
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Emprunt $emprunt)
    {
        $request->validate([
            'abonne'=>'required',
            'ouvrages'=>'required',
            'id_lignes'=>'required',
            'duree_emprunt' => 'required',
        ]);
        
        try {
            $id_lignes = $request->id_lignes;
            $ouvrages = $request->ouvrages;
            
            $date_retour = Controller::determinerDateRetour($request->duree_emprunt);
            $emprunt->date_retour = $date_retour;
            $emprunt->save();

            $lignesEmprunts = $emprunt->lignesEmprunts()->get();
            $old_id_lignes = $lignesEmprunts->pluck('id_ligne_emprunt')->toArray();

            $new_id_lignes = [];
            for ($i=0; $i < count($ouvrages); $i++) {
                if ($id_lignes[$i]=="-1"){
                    LignesEmprunt::create([
                        'etat_sortie' => 4,
                        'disponibilite' => false,
                        'id_ouvrage' => $ouvrages[$i],
                        'id_emprunt' => $emprunt->id_emprunt,
                    ]);
        
                    $ouvrage = Ouvrage::firstWhere('id_ouvrage', $ouvrages[$i]);
                    $ouvrage->decrementerNombreExemplaire();
                } else {
                    $ligneEmprunt = $lignesEmprunts->find($id_lignes[$i]);

                    array_push($new_id_lignes, $ligneEmprunt->id_ligne_emprunt);
                }
            }
        
            $deleted_id_lignes = array_diff($old_id_lignes, $new_id_lignes);
        
            foreach ($deleted_id_lignes as $id_ligne){
                
                $ligneEmprunt = $lignesEmprunts->find($id_ligne);
            
                $ligneEmprunt->ouvrage->incrementerNombreExemplaire();
                $ligneEmprunt->delete();
            }


            $abonne = Abonne::find($emprunt->id_abonne);
            $utilisateur = User::find($abonne->id_utilisateur);

            $email = $utilisateur->email;

            $date_retour = $emprunt->date_retour;

            $date_emprunt =  $emprunt->date_emprunt;

            $data = array(
                'user' => $utilisateur->nom_utilisateur,
                'date_retour' => $date_retour->format('d-m-Y'),
                'date_emprunt' => $date_emprunt->format('d-m-Y'),
                'ouvrages' => implode(';', $emprunt->ouvrageEmprunte),
            );

            //$jobMailEmprunt = new MailEmpruntJob($email, $data);
            //$jobMailEmprunt->delay(Carbon::now()->addSeconds($date_retour->subDays(2)));
            // $jobMailEmprunt->delay(Carbon::now()->addSeconds(5));
            // $this->dispatch($jobMailEmprunt);

            return redirect()->route('emprunts.index');
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emprunt $emprunt)
    {
        try {
            foreach($emprunt->lignesEmprunts as $ligneEmprunt){
                $ligneEmprunt->ouvrage->incrementerNombreExemplaire();
                $ligneEmprunt->delete();
            }
            $emprunt->delete();
            return redirect()->route('emprunts.index');
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    public function exportExcel()
    {
        return "";
    }
}
