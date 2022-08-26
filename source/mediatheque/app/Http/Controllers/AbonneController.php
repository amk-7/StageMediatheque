<?php

namespace App\Http\Controllers;

use App\Helpers\UtilisateurHelper;

use App\Models\Abonne;
use App\Models\User;
use Illuminate\Http\Request;

class AbonneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request['adresse'] = array(
            'ville' => $request->ville,
            'quartier' => $request->quartier
        );

        $utilisateur = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'nom_utilisateur' => $request->nom_utilisateur,
            'email' => $request->email,
            'password' => $request->password,
            'contact' => $request->contact,
            'photo_profil' => $request->photo_profil,
            'adresse' => $request->adresse,
            'sexe' => $request->sexe
        ]);

        $abonne = Abonne::create([
            'date_naissance' => $request->date_naissance,
            'niveau_etude' => $request->niveau_etude,
            'profession' => $request->profession,
            'contact_a_prevenir' => $request->contact_a_prevenir,
            'numero_carte' => $request->numero_carte,
            'type_de_carte' => $request->type_de_carte,
            'id_utilisateur' => $utilisateur->id_utilisateur
            
        ]);
        return redirect()->route('listeAbonnes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\Response
     */
    public function show(Abonne $abonne)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
        $abonne->date_naissance = $request["date_naissance"];
        $abonne->niveau_etude = $request["niveau_etude"];
        $abonne->profession = $request["profession"];
        $abonne->contact_a_prevenir = $request["contact_a_prevenir"];
        $abonne->numero_carte = $request["numero_carte"];
        $abonne->type_de_carte = $request["type_de_carte"];
        $abonne->save();        
        return redirect()->route('listeAbonnes');

        /*
        $abonne->date_naissance = $request["date_naissance"];
        $abonne->niveau_etude = $request["niveau_etude"];
        $abonne->profession = $request["profession"];
        $abonne->contact_a_prevenir = $request["contact_a_prevenir"];
        $abonne->numero_carte = $request["numero_carte"];
        $abonne->type_de_carte = $request["type_de_carte"];
        $abonne->save();
        return redirect()->route('abonne.index');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abonne $abonne)
    {
        //
        $abonne->delete();
        return redirect()->route('listeAbonnes');
    }
}
