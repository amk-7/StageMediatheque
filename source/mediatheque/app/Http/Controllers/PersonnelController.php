<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\User;
use App\Service\UserService;
use App\Service\GlobaleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
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
        $personnels = Personnel::paginate(10);
        return view('personnels.index')->with('personnels', $personnels);
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
            'nom_utilisateur'=>['required',
                function ($attribute, $value, $flail){
                    if (User::all()->where('nom_utilisateur', $value)->first()){
                        $flail("Ce nom est déjà utilisé.");
                    }
                }
            ],
        ])->validate();

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
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

        $utilisateur = User::all()->where('nom', '=', $request->nom)->where('prenom', '=', $request->prenom)->first();
        if(! $utilisateur){
            $utilisateur = UserService::enregistrerUtilisateur($request);
            Personnel::create([
                'statut' => $request->statut,
                'id_utilisateur' => $utilisateur->id_utilisateur
            ]);
        }
        $utilisateur->assignRole(Role::where('name', $request->statut));
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

        $request['adresse'] = array(
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'numero_maison' => $request->numero_maison,
        );

        $utilisateur = UserService::modifierUtilisateur($request, $personnel->id_utilisateur);
        $utilisateur->assignRole(Role::where('name', $request["statut"]));
        $utilisateur->save();
        $personnel->statut = $request["statut"];
        $personnel->save();
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
        if (! (Auth::user()->id_utilisateur == $personnel->utilisateur->id_utilisateur)){
            $personnel->delete();
        }
        return redirect()->route('listePersonnels');
    }
}
