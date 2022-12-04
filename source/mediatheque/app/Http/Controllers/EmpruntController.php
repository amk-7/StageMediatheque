<?php

namespace App\Http\Controllers;

use App\Exports\EmpruntExport;
use App\Helpers\OuvragesPhysiqueHelper;
use App\Models\Emprunt;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Abonne;
use App\Models\LignesEmprunt;
use App\Models\Personnel;
use App\Service\LignesEmpruntService;
use Auth;
use Illuminate\Http\Request;
use App\Service\OuvragesPhysiqueService;
use App\Service\PersonnelService;
use App\Service\AbonneService;
use App\Service\EmpruntService;
use App\Service\GlobaleService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMessage;
use Maatwebsite\Excel\Facades\Excel;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = 10;
        if ($_REQUEST['element'] ?? null) {
            //dd('a');
            //$utilisateur = User::where('nom', 'like', '%'.$_REQUEST['element'].'%')->orWhere('prenom', 'like', '%'.$_REQUEST['element'].'%')->get();
            $users = DB::table('users')
                ->select("id_utilisateur")
                ->where("nom", "like", "%".strtoupper($_REQUEST['element'])."%")
                ->orWhere("prenom", "like", "%".strtolower($_REQUEST['element'])."%")
                ->get();
            $users = GlobaleService::getArrayKeyFromDBResult($users, "id_utilisateur");
            //dd($utilisateur->count());
            //dd($users);
            if(count($users) != 0){
                //dd($users);
                //$abonne = Abonne::whereIn('id_utilisateur', $utilisateur->first()->id_utilisateur)->get();
                $abonnes = DB::table('abonnes')->select('id_abonne')->whereIn('id_utilisateur', $users)->get();
                //$abonne = Abonne::where('id_utilisateur', 'like', '%'.$utilisateur->first()->id_utilisateur.'%')->get();
                //dd($abonne);
                $abonnes = GlobaleService::getArrayKeyFromDBResult($abonnes, "id_abonne");
                $emprunts = Emprunt::whereIn('id_abonne', $abonnes)->paginate($paginate);
                //dd($emprunts);
            }else{
                $emprunts = new Collection();
                //dd($emprunts);
            }
            //dd($emprunts);
        } else {
            //dd('b');
            $emprunts = Emprunt::paginate($paginate);
        }


        return view('emprunt.index')->with([
            'emprunts' => $emprunts,
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
            "livre_papier" => json_encode(OuvragesPhysiqueService::getLivrePapierWithAllAttribute()),
            "document_audio_visuel" => json_encode(OuvragesPhysiqueService::getDocAVWithAllAttribute()),
            "personnels" => json_encode(PersonnelService::getPersonnelWithAllAttribut()),
            "abonnes" => json_encode(AbonneService::getAbonnesWithAllAttribut()),
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
        //

        //dd(Personnel::all()->where("id_utilisateur", Auth::user()->id_utilisateur)->first()->id_personnel);

        $request->validate([
            'nom_abonne'=>'required',
            'prenom_abonne'=>'required',
            'data'=>'required',
            'duree_emprunt' => 'required',

        ]);

        $date_retour = EmpruntService::determinerDateRetour($request->duree_emprunt);

        $emprunt = Emprunt::create([
            'date_emprunt' => date('Y-m-d'),
            'date_retour' => $date_retour,
            'id_abonne' => $request->prenom_abonne,
            'id_personnel' => Personnel::all()->where("id_utilisateur", Auth::user()->id_utilisateur)->first()->id_personnel,
        ]);

        //dd($listesEmprunts->restitution);
        LignesEmpruntService::enregistrerLignesEmprunt($request->data, $emprunt);
        //dd($request);

        //Envoyer un mail à l'abonné lorsque la date de retour est proche
        $abonne = Abonne::find($request->prenom_abonne);
        //dd($abonne);
        $utilisateur = User::find($abonne->id_utilisateur);
        //dd($utilisateur);
        $email = $utilisateur->email;
        //dd($email);
        $date_retour = $emprunt->date_retour;
        //dd($date_retour);
        $date_emprunt = $emprunt->date_emprunt;
        //dd($date_emprunt);
        $duree_emprunt = $request->duree_emprunt;
        //dd($duree_emprunt);

        $data = array(
            'nom' => $utilisateur->nom,
            'prenom' => $utilisateur->prenom,
            'date_retour' => $date_retour,
            'date_emprunt' => $date_emprunt,
            'duree_emprunt' => $duree_emprunt,
        );

        //dd($data);

        //Mail::to($email)->queue(new AlertMessage($data));

        Mail::to($email)->send(new AlertMessage($data));
        /*Mail::send('mails.alertMessage', $data, function($message) use ($email) {
            $message->to($email, 'Alerte')->subject
            ('Alerte de date de retour');
            $message->from('alertMessage','Alerte');
        });*/

        /*
        Mail::send('mails.mail', $data, function($message) use ($email) {
            $message->to($email, 'To Abonne')->subject
            ('Notification de date de retour');
            $message->from('a', 'Bibliothèque');
        });*/

        return redirect()->route("listeEmprunts");
    }

    public function storeReservationEmprunt(Request $request, Reservation $reservation){

        $date_retour = EmpruntService::determinerDateRetour("2");
        $reservation->etat = 0;
        $reservation->save();
        $emprunt = Emprunt::create([
            'date_emprunt' => date('Y-m-d'),
            'date_retour' => $date_retour,
            'id_abonne' => $reservation->abonne->id_abonne,
            'id_personnel' => Personnel::all()->where("id_utilisateur", Auth::user()->id_utilisateur)->first()->id_personnel,
        ]);
        LignesEmprunt::create([
            'etat_sortie' => array_search("Bon état", OuvragesPhysiqueHelper::demanderEtat()),
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
        //
        //dd($emprunt);
        return view('emprunt.show')->with([
            'emprunt'=>$emprunt,
            "personnels" => json_encode(PersonnelService::getPersonnelWithAllAttribut()),
            "abonnes" => json_encode(AbonneService::getAbonnesWithAllAttribut()),
            "livre_papier" => json_encode(OuvragesPhysiqueService::getLivrePapierWithAllAttribute()),
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
        //
        //dd(GlobaleService::afficherDate($emprunt->date_emprunt));
        return view('emprunt.edit')->with([
            'emprunt'=>$emprunt,
            "personnels" => json_encode(PersonnelService::getPersonnelWithAllAttribut()),
            "abonnes" => json_encode(AbonneService::getAbonnesWithAllAttribut()),
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
        //
        //dd($emprunt);
        $date_retour = EmpruntService::determinerDateRetour($request->duree_emprunt);
        //dd($date_retour);
        $emprunt->date_retour = $date_retour;
        $emprunt->save();

        /*$emprunt = Emprunt::find($id_emprunt);
        $emprunt->date_retour = date('Y-m-d');
        $emprunt->save();
        dd($emprunt);*/

        //$emprunt = Emprunt::find($id_emprunt);

        /*$emprunt->date_retour = $request['date_retour'];
        dd($emprunt->date_retour);
        $emprunt->save();*/


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
        //
        //dd($emprunt->lignesEmprunts);
        foreach($emprunt->lignesEmprunts as $ligneEmprunt){
            $ligneEmprunt->ouvragesPhysique->augmenterNombreExemplaire(1);
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
