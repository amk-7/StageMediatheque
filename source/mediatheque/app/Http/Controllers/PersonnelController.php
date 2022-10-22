<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\User;
use App\Service\UserService;
use App\Service\GlobaleService;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Spatie\Permission\Models\Role;

=======
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
>>>>>>> 4d09073acd175c47ba52c39eb37190c2601543fa
class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $personnels = Personnel::all();
        return view('personnels.index')->with('listePersonnels', $personnels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('personnels.create');
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

        //dd($request);

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
            'email' => 'required',
            'password' => 'required',
            'contact' => 'required',
            'ville' => 'required',
            'quartier' => 'required',
            'sexe' => 'required',
            'statut' => 'required'
        ]);

        $request['adresse'] = array(
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'numero_maison' => $request->numero_maison,
        );
        /*$utilisateur = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'nom_utilisateur' => $request->nom_utilisateur,
            'email' => $request->email,
            'password' => $request->password,
            'contact' => $request->contact,
            'photo_profil' => $request->photo_profil,
            'adresse' => $request->adresse,
            'sexe' => $request->sexe
<<<<<<< HEAD
        ]);
        
        $utilisateur->assignRole([Role::find(1), Role::find(2)]);
=======
        ]);*/
>>>>>>> 4d09073acd175c47ba52c39eb37190c2601543fa

        $utilisateur = User::all()->where('nom', '=', $request->nom)->where('prenom', '=', $request->prenom)->first();
        if(! $utilisateur){
            $utilisateur = UserService::enregistrerUtilisateur($request);
            Personnel::create([
                'statut' => $request->statut,
                'id_utilisateur' => $utilisateur->id_utilisateur
            ]);
        }        
        $utilisateur->assignRole([Role::find(2), Role::find(1)]);
        return redirect()->route('listePersonnels');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Personnel $personnel)
    {
        //
        return view('personnels.show')->with('personnel', $personnel);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Personnel $personnel)
    {
        //
        return view('personnels.edit')->with(['personnel'=> $personnel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personnel $personnel)
    {
        //
        //dd($request["statut"]);
        
        /*$personnel->update(array([
            'statut' => $request["statut"]
        ]));*/
        $request['adresse'] = array(
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'numero_maison' => $request->numero_maison,
        );
        
        $utilisateurs = UserService::modifierUtilisateur($request, $personnel->id_utilisateur);
        $utilisateurs->save();
        $personnel->statut = $request["statut"];
        $personnel->save();
        //dd($personnel);
        return redirect()->route('listePersonnels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personnel $personnel)
    {
        //
        $personnel->delete();
        return redirect()->route('listePersonnels');
    }
}
