<?php

namespace App\Http\Controllers;

use App\Helpers\UtilisateurHelper;

use App\Models\Abonne;
use App\Models\User;
use DB;
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


        
        /*for($i=0; $i<count([$request->nom, $request->prenom]); $i++){
            if(!UtilisateurHelper::verifierSiUtilisateurExist($request->nom[$i], $request->prenom[$i])){
                $utilisateur = User::Create([
                    "nom"=>strtoupper($request->nom[$i]),
                    "prenom"=>ucfirst($request->prenom[$i]),
                    'nom_utilisateur' => $request->nom_utilisateur[$i],
                    'email' => $request->email[$i],
                    'password' => $request->password[$i],
                    'contact' => $request->contact[$i],
                    'photo_profil' => $request->photo_profil[$i],
                    'adresse' => $request->adresse[$i],
                    'sexe' => $request->sexe[$i],

            ]);
            $abonne = Abonne::Create([
                'id_utilisateur' => $utilisateur->id_utilisateur,
                'date_naissance' => $request->date_naissance[$i],
                'niveau_etude' => $request->niveau_etude[$i],
                'profession' => $request->profession[$i],
                'contact_a_prevenir' => $request->contact_a_prevenir[$i],
                'numero_carte' => $request->numero_carte[$i],
                'type_de_carte' => $request->type_de_carte[$i]
            ]);
        }
        else{
            return redirect()->back()->with('error', 'Cet utilisateur existe déjà');
            }
        }*/

        /*
        $elements = DB::table('users')->where('nom', $request->nom)->where('prenom', $request->prenom)->get();
        dd($elements);*/

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
            'date_naissance' => 'required',
            'niveau_etude' => 'required',
            'profession' => 'required',
            'contact_a_prevenir' => 'required',
            'numero_carte' => 'required',
            'type_de_carte' => 'required'
        ]);

        $request['adresse'] = array(
            'ville' => $request->ville,
            'quartier' => $request->quartier
        );

        $utilisateurs = User::all()->where('nom', '=', $request->nom)->where('prenom', '=', $request->prenom);
        if(count($utilisateurs)!=0){
            return 'cet utilisateur exist deja';
        }else{
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
        }
        $abonne->save();
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
        return view('abonnes.show')->with('abonne', $abonne);

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
