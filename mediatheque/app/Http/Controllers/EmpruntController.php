<?php

namespace App\Http\Controllers;

use App\Exports\EmpruntExport;
use App\Models\Emprunt;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Abonne;
use App\Models\LignesEmprunt;
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

        if (! in_array($request->nom_abonne, ["Séléctionner nom", null])) {
            if ($request->prenom_abonne != "Séléctionner prénom" ?? null){
                $abonnes = array($request->prenom_abonne);
            } else {
                $users = DB::table('users')
                    ->select("id_utilisateur")
                    ->where("nom", "like", "%".strtoupper($request->nom_abonne)."%")
                    ->get()->pluck('id_utilisateur');
                $abonnes = DB::table('abonnes')->select('id_abonne')->whereIn('id_utilisateur', $users)->get()->pluck('id_abonne');
            }
            $emprunts = Emprunt::whereIn('id_abonne', $abonnes)->paginate($paginate);
        } else {
            $emprunts = Emprunt::paginate($paginate);
        }


        return view('emprunt.index')->with([
            'emprunts' => $emprunts,
            'abonnes' => json_encode(Abonne::getAbonnesWithAllAttribut()),
        ]);
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

        $jobMailEmprunt = new MailEmpruntJob($email, $data);
        //$jobMailEmprunt->delay(Carbon::now()->addSeconds($date_retour->subDays(2)));
        $jobMailEmprunt->delay(Carbon::now()->addSeconds(5));
        $this->dispatch($jobMailEmprunt);
        return redirect()->route("listeEmprunts");
    }

    public function storeReservationEmprunt(Request $request, Reservation $reservation){

        $date_retour = Controller::determinerDateRetour("2");
        $reservation->etat = 0;
        $reservation->save();
        $emprunt = Emprunt::create([
            'date_emprunt' => date('Y-m-d'),
            'date_retour' => $date_retour,
            'id_abonne' => $reservation->abonne->id_abonne,
            'id_personnel' => Personnel::all()->where("id_utilisateur", Auth::user()->id_utilisateur)->first()->id_personnel,
        ]);
        LignesEmprunt::create([
            'etat_sortie' => array_search($request->etat, OuvragesPhysiqueHelper::demanderEtat()),
            'disponibilite' => false,
            'id_ouvrage_physique' => $reservation->ouvragePhysique->id_ouvrage_physique,
            'id_emprunt' => $emprunt->id_emprunt,
        ]);
        return redirect()->route("listeReservations");
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
        return Excel::download(new EmpruntExport(), 'liste_des_emprunt.xlsx');
    }
}
