<?php

namespace App\Http\Controllers;

use App\Jobs\CancelRegistrationJob;
use App\Models\Liquide;
use App\Models\Registration;
use App\Models\TarifAbonnement;
use App\Service\AbonneService;
use App\Service\EmpruntService;
use App\Service\GlobaleService;
use App\Service\PersonnelService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LiquideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('liquide.index')->with([
                "liquides" => Liquide::paginate(10),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('liquide.create')->with([
            "abonnes" => json_encode(AbonneService::getAbonnesRegistrateWithAllAttribut()),
            "tarifs" => TarifAbonnement::all()->toJson(),
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
            "nom_abonnes" => "required",
            "prenom_abonnes" => "required",
            "tarifs" => "required",
        ]);

        $tarifs = TarifAbonnement::all()->where("tarif", $request->tarifs)->first();
        $registration = Registration::create([
            "id_tarif_abonnement" => $tarifs->id_tarif_abonnement,
            'id_abonne'=>$request->prenom_abonnes,
            "date_debut" => date("Y-m-d"),
            "date_fin" => GlobaleService::determinerDateFinAbonnement($tarifs->duree_validite),
        ]);
        $concelRegistrationJob = new CancelRegistrationJob($registration->id_registration);
        $concelRegistrationJob->delay(Carbon::now()->addDay($tarifs->duree_validite));
        $this->dispatch($concelRegistrationJob);
        Liquide::create([
            "id_registration" => $registration->id_registration,
        ]);
        return redirect()->route("listeLiquides");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Liquide  $liquide
     * @return \Illuminate\Http\Response
     */
    public function show(Liquide $liquide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Liquide  $liquide
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Liquide $liquide)
    {
        return view('liquide.create')->with([
            "personnels" => json_encode(PersonnelService::getPersonnelWithAllAttribut()),
            "abonnes" => json_encode(AbonneService::getAbonnesWithAllAttribut()),
            "tarifs" => TarifAbonnement::all()->toJson(),
            "liquide" => $liquide,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Liquide  $liquide
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Liquide $liquide)
    {

        $request->validate([
            "nom_personnes" => "required",
            "prenom_personnes" => "required",
            "nom_abonnes" => "required",
            "prenom_abonnes" => "required",
            "tarifs" => "required",
            "paye" => "required",
        ]);

        if ($request->paye == "non"){
            return redirect()->route("listeLiquides");
        }
        $tarifs = TarifAbonnement::all()->where("designation", $request->tarifs)->first();
        $liquide->registration->id_tarif_abonnement = $tarifs->id_tarif_abonnement;
        $liquide->registration->id_abonne = $tarifs->id_tarif_abonnement;
        $liquide->registration->date_fin = EmpruntService::updateDateRetour($tarifs->duree_validite,  date_create( $liquide->registration->date_debut));

        Liquide::create([
            "id_registration" => $liquide->registration->id_registration,
        ]);
        return redirect()->route("listeLiquides");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Liquide  $liquide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liquide $liquide)
    {
        //
    }
}
