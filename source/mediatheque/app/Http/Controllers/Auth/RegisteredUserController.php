<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Abonne;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Service\GlobaleService;
use App\Service\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('abonnes.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
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
            $user = UserService::enregistrerUtilisateur($request);
            Abonne::create([
                'date_naissance' => $request->date_naissance,
                'niveau_etude' => $request->niveau_etude,
                'profession' => $request->profession,
                'contact_a_prevenir' => $request->contact_a_prevenir,
                'numero_carte' => $request->numero_carte,
                'type_de_carte' => $request->type_de_carte,
                'id_utilisateur' => $user->id_utilisateur
            ]);
        } else {
            return redirect()->route('login');
        }

        $user->assignRole(Role::find(3));

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
