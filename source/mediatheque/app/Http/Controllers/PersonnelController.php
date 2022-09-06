<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;

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
            'quartier' => $request->quartier
        );
        $utilisateur = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'nom_utilisateur' => $request->nom_utilisateur,
            'numero_maison' => $request->numero_maison,
            'email' => $request->email,
            'password' => $request->password,
            'contact' => $request->contact,
            'photo_profil' => $request->photo_profil,
            'adresse' => $request->adresse,
            'sexe' => $request->sexe
        ]);

        $personnel = Personnel::create([
            'statut' => $request->statut,
            'id_utilisateur' => $utilisateur->id_utilisateur
        ]);

        $personnel->save();
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
            'quartier' => $request->quartier
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
