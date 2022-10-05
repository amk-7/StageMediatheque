<?php

namespace App\Http\Controllers;

use App\Helpers\UtilisateurHelper;

use App\Models\Abonne;
use App\Models\User;
use App\Service\GlobaleService;
use App\Service\UserService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AbonneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return 'salut';
        $abonnes = Abonne::all();
        return view('abonnes.index')->with('listeAbonnes', $abonnes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        /*$msg = "---";
        if (UtilisateurHelper::verifierSiUtilisateurExist(null, null)){
            $msg = "hello";
        }
        return $msg;*/

        return view('abonnes.create');
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
            'numero_carte'=>['required',
                function ($attribute, $value, $flail){
                    if (! GlobaleService::verifieCart($value)){
                        $flail("Ce numéro de carte est invalide");
                    }
                }
            ],
        ])->validate();

        Validator::make($request->all(), [
            'contact'=>['required',
                function ($attribute, $value, $flail){
                    if (! GlobaleService::verifieContact($value)){
                        $flail("Ce ".$attribute." est invalide");
                    }
                }
            ],
        ])->validate();

        Validator::make($request->all(), [
            'contact_a_prevenir'=>['required',
                function ($attribute, $value, $flail){
                    if (! GlobaleService::verifieContact($value)){
                        $flail("Ce ".$attribute." est invalide");
                    }
                }
            ],
        ])->validate();

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'nom_utilisateur' => 'required',
            'password' => 'required',
            'ville' => 'required',
            'quartier' => 'required',
            'sexe' => 'required',
            'date_naissance' => 'required',
            'niveau_etude' => 'required',
            'profession' => 'required',
            'type_de_carte' => 'required'
        ]);

        $request['adresse'] = array(
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'numero_maison' => $request->numero_maison,
        );

        // Vérification des contacts.

        $utilisateur = User::all()->where('nom', '=', $request->nom)->where('prenom', '=', $request->prenom)->first();
        if(! $utilisateur){
            $utilisateur = UserService::enregistrerUtilisateur($request);
            Abonne::create([
                'date_naissance' => $request->date_naissance,
                'niveau_etude' => $request->niveau_etude,
                'profession' => $request->profession,
                'contact_a_prevenir' => $request->contact_a_prevenir,
                'numero_carte' => $request->numero_carte,
                'type_de_carte' => $request->type_de_carte,
                'id_utilisateur' => $utilisateur->id_utilisateur
            ]);
        }
        $utilisateur->assignRole(Role::find(3));

        return redirect()->route('listeAbonnes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Abonne $abonne)
    {
        //
        return view('abonnes.show')->with('abonne', $abonne);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Abonne $abonne)
    {
        //
        return view('abonnes.edit')->with('abonne', $abonne);
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
        //


        /*$abonne->update(array([
            'date_naissance' => $request["date_naissance"],
            'niveau_etude' => $request["niveau_etude"],
            'profession' => $request["profession"],
            'contact_a_prevenir' => $request["contact_a_prevenir"],
            'numero_carte' => $request["numero_carte"],
            'type_de_carte' => $request["type_de_carte"]
        ]));*/
        $request['adresse'] = array(
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'numero_maison' => $request->numero_maison,
        );

        $utilisateurs = UserService::modifierUtilisateur($request, $abonne->id_utilisateur);
        $utilisateurs->save();
        $abonne->date_naissance = $request["date_naissance"];
        $abonne->niveau_etude = $request["niveau_etude"];
        $abonne->profession = $request["profession"];
        $abonne->contact_a_prevenir = $request["contact_a_prevenir"];
        $abonne->numero_carte = $request["numero_carte"];
        $abonne->type_de_carte = $request["type_de_carte"];
        $abonne->save();
        return redirect()->route('listeAbonnes');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Abonne $abonne)
    {
        //
        $abonne->delete();
        return redirect()->route('listeAbonnes');
    }

    public function mesEmprunts(Abonne $abonne)
    {
        $emprunts = $abonne->emprunts()->get();
        return view('abonnes.mes_emprunt')->with('emprunts', $emprunts);
    }

    public function mesEmpruntsEnCours(Abonne $abonne)
    {
        $emprunts = $abonne->getEmpruntsEnCours();
        return view('abonnes.mes_emprunt_actuelle')->with('emprunts', $emprunts);
    }
}
