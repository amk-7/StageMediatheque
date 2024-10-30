<?php

namespace App\Http\Controllers;

use App\Exports\AbonnesExport;
use App\Imports\AbonneImport;
use App\Models\Abonne;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PharIo\Version\Exception;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AbonneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $abonnes = "";
            $paginate = 10;
            $selected_search_by = $request->search_by;
            $selected_profession = $request->profession;
            $selected_niveau_etude = $request->niveau_etude;
            $selected_etat = $request->etat;

            if (isset($selected_search_by) || isset($request->profession) || isset($selected_niveau_etude) || isset($selected_etat)){
                $users = DB::table('users')
                    ->select("id_utilisateur")
                    ->where("nom", "like", "%".strtoupper($request->search_by)."%")
                    ->orWhere("prenom", "like", "%".strtolower($request->search_by)."%")
                    ->get();
                $userIds = $users->pluck('id_utilisateur')->toArray();
                $professions = ["Retraite", "Etudiant", "Fonctionnaire", "Elève"];
                if (! empty($request->profession)){
                    $professions = [$request->profession];
                }
                $niveau_etudes = ["Université", "Lycée", "Collège", "Primaire"];
                if (! empty($request->niveau_etude)){
                    $niveau_etudes = [$request->niveau_etude];
                }

                $abonnes = Abonne::whereIn("id_utilisateur", $userIds)
                            ->with(['utilisateur'])
                            ->whereIn("profession", $professions)
                            ->where("etat", boolval($request->etat))
                            ->whereIn("niveau_etude", $niveau_etudes)->paginate($paginate);

            } else {
                $abonnes = Abonne::with(['utilisateur'])->paginate($paginate);
            }

            \Session(['abonnes_key' => $abonnes->pluck('id_abonne')->toArray()]);
            \Session(['paye' => $request->paye]);

            return view('abonnes.index')->with([
                'abonnes' => $abonnes,
                'paye' => $request->paye,
                'selected_search_by' => $selected_search_by,
                'selected_profession' => $selected_profession,
                'selected_niveau_etude' => $selected_niveau_etude,
                'selected_etat' => $selected_etat,
                ]);
        } catch (\Throwable $th) {
            abort(500, "");
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
            return view('abonnes.create');
        } catch (\Throwable $th) {
            abort(500, "");
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
            'nom' => 'required',
            'prenom' => 'required',
            'password' => 'required | min:8',
            'confirmation_password' => 'required|same:password',
            'ville' => 'required',
            'quartier' => 'required',
            'sexe' => 'required',
            'date_naissance' => 'required',
            'niveau_etude' => 'required',
            'profession' => 'required',
            'type_de_carte' => 'required'
        ]);

        Validator::make($request->all(), [
            'nom_utilisateur'=>['required',
                function ($attribute, $value, $flail){
                    if (User::all()->where('nom_utilisateur', $value)->first()){
                        $flail("Le nom '$value' est déjà utilisé.");
                    }
                }
            ],
        ])->validate();


        try {
            if (Auth::user()){
                $request->validate(['profil_valide' => 'required']);
            }
    
            $request['adresse'] = array(
                'ville' => $request->ville,
                'quartier' => $request->quartier,
                'numero_maison' => $request->numero_maison,
            );
    
            if ($request->password != $request->confirmation_password){
                return redirect()->back()->withInput()->with('error', "Assurez vous d'avoir saisi des mots de passe identiques");
            }
    
            $utilisateur = User::where('nom', '=', $request->nom)
                                        ->where('prenom', '=', $request->prenom)
                                        ->where('nom_utilisateur', '=', $request->nom_utilisateur)
                                        ->first();
    
            if(! $utilisateur){
                $utilisateur = User::enregistrerUtilisateur($request);
                Abonne::create([
                    'date_naissance' => $request->date_naissance,
                    'niveau_etude' => $request->niveau_etude,
                    'profession' => $request->profession ?? '',
                    'contact_a_prevenir' => $request->contact_a_prevenir?? '',
                    'numero_carte' => $request->numero_carte ?? '',
                    'type_de_carte' => $request->type_de_carte ?? 0,
                    'id_utilisateur' => $utilisateur->id_utilisateur,
                    'profil_valider' => $request->profil_valide ?? 0,
                ]);
                $utilisateur->assignRole(Role::find(3));
                //Mail::to($utilisateur->email)->queue(new Contact($utilisateur->userfullName, $utilisateur->nom_utilisateur));
                return redirect('liste_des_abonnes');
            } else {
                return redirect()->back()->withInput()->withErrors(['users_exist' => "L'utilisateur $request->nom $request->prenom avec le nom d'utilisateur $request->nom_utilisateur existe déjà."]);
            }
        } catch (\Throwable $th) {
            abort(500, "");
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Abonne $abonne)
    {
        try {
            return view('abonnes.show')->with('abonne', $abonne);
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Abonne $abonne)
    {
        try {
            return view('abonnes.edit')->with('abonne', $abonne);
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Abonne $abonne)
    {
        $request['adresse'] = array(
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'numero_maison' => $request->numero_maison,
        );

        try {
            $utilisateur = User::modifierUtilisateur($request, $abonne->id_utilisateur);
            $utilisateur->save();
            $abonne->date_naissance = $request["date_naissance"];
            $abonne->niveau_etude = $request["niveau_etude"];
            $abonne->profession = $request["profession"];
            $abonne->contact_a_prevenir = $request["contact_a_prevenir"];
            $abonne->numero_carte = $request["numero_carte"];
            $abonne->type_de_carte = $request["type_de_carte"];
            $abonne->save();
            $utilisateur->assignRole(Role::find(3));
            //dd(Auth::user()->hasRole('abonne'));
            if (Auth::user()->hasRole('abonne')){
                return redirect("affiche_abonne/$abonne->id_abonne");
            } else {
                $abonne->profil_valider = $request->profil_valide;
                // Mail::to($utilisateur->email)->queue(new Contact($utilisateur->userfullName, $utilisateur->nom_utilisateur));
                return redirect()->route('abonnes.index');
            }
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Abonne $abonne)
    {
        try {
            $abonne->etat=false;
        $abonne->save();
        return redirect()->route('listeAbonnes');
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    public function fenix_user(Abonne $abonne)
    {
        try {
            $abonne->etat = true;
            $abonne->save();
            return redirect()->route('listeAbonnes');
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    public function mesEmprunts(Abonne $abonne)
    {
        $emprunts = $abonne->emprunts()->get();
        return view('abonnes.mes_emprunt')->with('emprunts', $emprunts);
    }

    public function mesEmpruntsEnCours(Abonne $abonne)
    {
        $emprunts = Collect($abonne->getEmpruntsEnCours());
        return view('abonnes.mes_emprunt')->with('emprunts', $emprunts);
    }

    public function exportExcel()
    {
        try {
            return Excel::download(new AbonnesExport(), "liste_des_abonnes.xlsx");
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        dump($file);
        try {

            Excel::import(new AbonneImport, $file);
            // try {
            //     $spreadsheet = IOFactory::load($file);
            //     $sheet = $spreadsheet->getActiveSheet();
            //     $data = $sheet->toArray();
            //     // foreach ($data as $i => $row) {
            //     //     $i++;
            //     //     dump($row);

            //     //     $nom = $row

            //     //     $utilisateur = User::create([
            //     //         'nom' => strtoupper($request->nom),
            //     //         'prenom' => strtolower($request->prenom),
            //     //         'nom_utilisateur' => $request->nom_utilisateur,
            //     //         'email' => $request->email,
            //     //         'password' => '',
            //     //         'contact' => $request->contact ?? '',
            //     //         'photo_profil' => $chemin_image,
            //     //         'adresse' => $request->adresse,
            //     //         'sexe' => $request->sexe,
            
            //     //     ]);

            //     //     // $utilisateur = User::where('nom', '=', $request->nom)
            //     //     //                 ->where('prenom', '=', $request->prenom)
            //     //     //                 ->where('nom_utilisateur', '=', $request->nom_utilisateur)
            //     //     //                 ->first();
            //     //     // $utilisateur = User::enregistrerUtilisateur($request);
            //     //     // Abonne::create([
            //     //     //     'date_naissance' => $request->date_naissance,
            //     //     //     'niveau_etude' => $request->niveau_etude,
            //     //     //     'profession' => $request->profession ?? '',
            //     //     //     'contact_a_prevenir' => $request->contact_a_prevenir?? '',
            //     //     //     'numero_carte' => $request->numero_carte ?? '',
            //     //     //     'type_de_carte' => $request->type_de_carte ?? 0,
            //     //     //     'id_utilisateur' => $utilisateur->id_utilisateur,
            //     //     //     'profil_valider' => $request->profil_valide ?? 0,
            //     //     // ]);
            //     //     // $utilisateur->assignRole(Role::find(3));
            

            //     // }
            // } catch (\Exception $e) {
            //     dd($e->getMessage());
            // }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        dd("Arrêt.. !");

        return redirect()->route('listeAbonnes');
    }

}
