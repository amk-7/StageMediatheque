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
        $paginate = 10;

        $start_date = $request->input('start_date', date('Y-01-01'));
        $end_date = $request->input('end_date', date('Y-m-d'));
        $search = $request->input('search');
        
        $emprunts = Emprunt::whereBetween('date_emprunt', [$start_date, $end_date])
                                                ->whereHas('abonne', function ($query) use ($search) {
                                                    $query->whereHas('utilisateur', function ($query) use ($search) {
                                                        $query->where("nom", "like", "%".strtoupper($search)."%");
                                                    });
                                                })
                                                ->orderBy('date_emprunt', 'desc')->paginate($paginate);
        
        $abonnes = json_encode(Abonne::getAbonnesWithAllAttribut());
        return view('emprunt.index', compact('emprunts', 'start_date', 'end_date', 'search'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('emprunt.create')->with([
            "ouvrages" => json_encode(Ouvrage::where('nombre_exemplaire', '>', 0)->get()),
            "personnels" => json_encode(Personnel::fullAttributs()),
            "abonnes" => json_encode(Abonne::getAbonnesValidateWithAllAttribut()),
        ]);
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
            'nom_abonne'=>'required',
            'prenom_abonne'=>'required',
            'data'=>'required',
            'duree_emprunt' => 'required',

        ]);


        $date_retour = Controller::determinerDateRetour($request->duree_emprunt);

        $emprunt = Emprunt::create([
            'date_emprunt' => date('Y-m-d'),
            'date_retour' => $date_retour,
            'id_abonne' => $request->prenom_abonne,
            'id_personnel' => Personnel::all()->where("id_utilisateur", Auth::user()->id_utilisateur)->first()->id_personnel,
        ]);


        Emprunt::enregistrerLignesEmprunt($request->data, $emprunt);

        $abonne = Abonne::find($request->prenom_abonne);

        $utilisateur = User::find($abonne->id_utilisateur);

        $email = $utilisateur->email;

        $date_retour = $emprunt->date_retour;

        $date_emprunt = $emprunt->date_emprunt;

        $duree_emprunt = $request->duree_emprunt;

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
        return redirect()->route("listeEmprunts");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Emprunt $emprunt)
    {
        return view('emprunt.show')->with([
            'emprunt'=>$emprunt,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Emprunt $emprunt)
    {

        return view('emprunt.edit')->with([
            'emprunt'=>$emprunt,
            "personnels" => json_encode(Personnel::fullAttributs()),
            "abonnes" => json_encode(Abonne::getAbonnesWithAllAttribut()),
        ]);
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

        $date_retour = Controller::determinerDateRetour($request->duree_emprunt);
        $emprunt->date_retour = $date_retour;
        $emprunt->save();

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

        $jobMailEmprunt = new MailEmpruntJob($email, $data);
        //$jobMailEmprunt->delay(Carbon::now()->addSeconds($date_retour->subDays(2)));
        $jobMailEmprunt->delay(Carbon::now()->addSeconds(5));
        $this->dispatch($jobMailEmprunt);

        return redirect()->route('listeEmprunts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emprunt  $emprunt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emprunt $emprunt)
    {
        foreach($emprunt->lignesEmprunts as $ligneEmprunt){
            $ligneEmprunt->ouvrage->augmenterNombreExemplaire(1);
            $ligneEmprunt->delete();
        }
        $emprunt->delete();
        return redirect()->route('listeEmprunts');
    }

    public function exportExcel()
    {
        return "";
    }
}
