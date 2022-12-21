<?php

namespace App\Http\Controllers;

use App\Jobs\CancelReservationJob;
use App\Models\Abonne;
use App\Models\OuvragesPhysique;
use App\Models\Reservation;
use App\Service\AbonneService;
use App\Service\GlobaleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 10;
        $reservation = array();
        //dd($request);
        if (! in_array($request->nom_abonne, ["Séléctionner nom", null])) {
            if ($request->prenom_abonne != "Séléctionner prénom" ?? null){
                $abonnes = array($request->prenom_abonne);
            } else {
                $users = DB::table('users')
                    ->select("id_utilisateur")
                    ->where("nom", "like", "%".strtoupper($request->nom_abonne)."%")
                    ->get();
                $users = GlobaleService::getArrayKeyFromDBResult($users, "id_utilisateur");
                $abonnes = DB::table('abonnes')->select('id_abonne')->whereIn('id_utilisateur', $users)->get();
                $abonnes = GlobaleService::getArrayKeyFromDBResult($abonnes, "id_abonne");
            }

            if(count($abonnes) != 0){
                if ($request->etat == "-1"){
                    $reservation = Reservation::whereIn('id_abonne', $abonnes)->paginate($paginate);
                } else {
                    $etat = (int) $request->etat;
                    $reservation = Reservation::whereIn('id_abonne', $abonnes)
                                                ->where('etat', $etat)->paginate($paginate);
                }
            }else{
                $reservation = new Collection();
            }
        } else {
            if ( in_array($request->etat, ["-1", null])){
                $reservation = Reservation::paginate($paginate);
            } else {
                $etat = (int) $request->etat;
                $reservation = Reservation::where('etat', $etat)->paginate($paginate);
            }
        }

        return view('reservation.index')->with(array(
            'reservations' => $reservation,
            'abonnes' => json_encode(AbonneService::getAbonnesWithAllAttribut()),
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        \session(['my_valiation_message' => ""]);
        \session(['my_message' => ""]);

        $abonne = Abonne::all()->where('id_utilisateur', Auth::user()->id_utilisateur)->first();
        $ouvragep = OuvragesPhysique::all()->where('id_ouvrage_physique', $request->data)->first();
        $ouvrageDejaReserver = Reservation::all()->where('id_abonne', $abonne->id_abonne)->where('id_ouvrage_physique', $ouvragep->id_ouvrage_physique)
                                                ->where('etat', 1)->first();

        if ( ! $ouvragep->estDisponible()){
            $message = "L'ouvrage n'est plus disponible.";
            \session(['my_message' => $message]);
            return redirect()->route('listeLivresPapier');
        }
        if ($ouvrageDejaReserver){
            $message = "Vous avez déjà reserver un exemplaire de cet ouvrage.";
            \session(['my_message' => $message]);
            return redirect()->route('listeLivresPapier');
        }
        if ($abonne->reservationValide()->count() > 4){
            $message = "Vous avez atteind le nombre de réservation";
            \session(['my_message' => $message]);
            return redirect()->route('listeLivresPapier');
        }

        $reservation = Reservation::create(array(
            'date_reservation' =>Carbon::now(),
            'id_abonne' => $abonne->id_abonne,
            'id_ouvrage_physique' => $ouvragep->id_ouvrage_physique,
        ));

        $jobCancelReservation = new CancelReservationJob($reservation->id_reservation);
        $jobCancelReservation->delay(Carbon::now()->addHours(24));
        $this->dispatch($jobCancelReservation);

        $ouvragep->decrementerNombreExemplaire();

        $validatonMessage = "Vous avez reservé l'ouvrage : ".$ouvragep->ouvrage->titre;
        \session(['my_valiation_message' => $validatonMessage]);
        return redirect()->route('listeLivresPapier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->ouvragePhysique->augmenterNombreExemplaire(1);
        $reservation->delete();
        return redirect()->route('listeReservations');
    }
}
