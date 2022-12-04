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
    public function index()
    {
        $paginate = 10;
        $reservation = array();
        if ($_REQUEST['element'] ?? null) {

            $users = DB::table('users')
                ->select("id_utilisateur")
                ->where("nom", "like", "%".strtoupper($_REQUEST['element'])."%")
                ->orWhere("prenom", "like", "%".strtolower($_REQUEST['element'])."%")
                ->get();
            $users = GlobaleService::getArrayKeyFromDBResult($users, "id_utilisateur");

            if(count($users) != 0){

                $abonnes = DB::table('abonnes')->select('id_abonne')->whereIn('id_utilisateur', $users)->get();

                $abonnes = GlobaleService::getArrayKeyFromDBResult($abonnes, "id_abonne");
                $reservation = Reservation::whereIn('id_abonne', $abonnes)->paginate($paginate);
            }else{
                $reservation = new Collection();
            }
        } else {
            $reservation = Reservation::paginate($paginate);
        }

        return view('reservation.index')->with(array(
            'reservations' => $reservation,
            "abonnes" => json_encode(AbonneService::getAbonnesWithAllAttribut()),
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
        $abonne = Abonne::all()->where('id_utilisateur', Auth::user()->id_utilisateur)->first();
        $ouvragep = OuvragesPhysique::all()->where('id_ouvrage_physique', $request->data)->first();
        $ouvrageDejaReserver = Reservation::all()->where('id_abonne', $abonne->id_abonne)->where('id_ouvrage_physique', $ouvragep->id_ouvrage_physique)->first();
        if ( ! $ouvragep->estDisponible()){
            return redirect()->route('listeLivresPapier');
        }
        if ($ouvrageDejaReserver){
            return redirect()->route('listeLivresPapier');
        }
        if ($abonne->reservationValide()->count() > 4){
            return redirect()->route('listeLivresPapier');
        }

        $reservation = Reservation::create(array(
            'id_abonne' => $abonne->id_abonne,
            'id_ouvrage_physique' => $ouvragep->id_ouvrage_physique,
        ));

        $jobCancelReservation = new CancelReservationJob($reservation->id_reservation);
        $jobCancelReservation->delay(Carbon::now()->addHour(10));
        $this->dispatch($jobCancelReservation);

        $ouvragep->decrementerNombreExemplaire();

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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
