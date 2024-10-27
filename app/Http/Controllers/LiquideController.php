<?php

namespace App\Http\Controllers;

use App\Jobs\CancelRegistrationJob;
use App\Models\Liquide;
use App\Models\Registration;
use App\Models\TarifAbonnement;
use App\Models\Abonne;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\AbonnementsExport;
use Maatwebsite\Excel\Facades\Excel;

class LiquideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(Liquide::all());
        // foreach (Liquide::all() as $liquide) {
        //     $liquide->registration->etat = 1;
        //     $liquide->registration->save();
        // }
        $moment_year = date('Y');
        $global_min_year = 2024;
        $min_annee = $global_min_year;
        $max_annee = $moment_year;

        $selected_min = $request->input('min_annee');
        $selected_max = $request->input('min_annee');
        $selected_etat = $request->input('etat');

        $paginate_number = 10;

        if ( $selected_min !== null || $selected_max !== null || $selected_etat !== null) {
            $query = Liquide::query();

            $query->join('registrations', 'liquides.id_registration', '=', 'registrations.id_registration');

            if ($selected_min && $selected_min !== "") {
                $query->whereYear('registrations.date_debut', '>=', $selected_min);
            }

            if ($selected_max && $selected_max !== "") {
                $query->whereYear('registrations.date_fin', '<=', $selected_max);
            }

            if ($selected_etat !== "") {
                $query->where('registrations.etat', $selected_etat);
            }
        } else {
            $query = Liquide::query();
        }
        session()->put('id_liquides', $query->pluck('id_liquide'));
        $liquides = $query->paginate($paginate_number);
        $query->orderBy('registrations.date_debut', 'desc');
        //dd(session()->get('id_liquides'));

        return view('liquide.index')->with([
                "liquides" => $liquides,
                "selected_etat" => $selected_etat,
                "selected_min" => $selected_min,
                "selected_max" => $selected_max,
                "min_annee" => $min_annee,
                "max_annee" => $max_annee,
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
            "abonnes" => json_encode(Abonne::getAbonnesRegistrateWithAllAttribut()),
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
            "date_fin" => Controller::determinerDateFinAbonnement($tarifs->duree_validite),
        ]);
        /*$concelRegistrationJob = new CancelRegistrationJob($registration->id_registration);
        $concelRegistrationJob->delay(Carbon::now()->addDay($tarifs->duree_validite));
        $this->dispatch($concelRegistrationJob);*/
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
        $liquide->registration->etat = 0;
        $liquide->registration->save();
        return redirect()->route("listeLiquides");
    }

    public function delete_all(Request $request)
    {
        foreach (Registration::all() as $registration){
            $registration->etat = 0;
            $registration->save();
        }
        return redirect()->route("listeLiquides");
    }

    public function export()
    {
        //dd("Okay");
        return Excel::download(new AbonnementsExport(), "liste_des_abonnements.xlsx");
    }
}
