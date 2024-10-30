<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\OuvragesPhysique;
use App\Models\Ouvrage;
use App\Models\Personnel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class ApprovisionnementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $start_date = $request->input('start_date', date('Y-01-01'));
            $end_date = $request->input('end_date', Carbon::now()->addDay(1));
            $title = $request->input('search');
    
            $approvisionnements = Approvisionnement::whereBetween('date_approvisionnement', [$start_date, $end_date])
                                                    ->whereHas('ouvrage', function ($query) use ($title) {
                                                        $query->where('titre', 'like', "%$title%");
                                                    })
                                                    ->orderBy('date_approvisionnement', 'desc')->paginate(10);
            
            return view('approvisionnements.index', compact('approvisionnements', 'start_date', 'end_date', 'title'));
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('approvisionnements.create')->with([
                "ouvrages" => Ouvrage::all(),
            ]);
        } catch (\Throwable $th) {
            abort(500, "");
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validated_data = $request->validate([
            'ids_ouvrages' => 'required',
            'nombres_exemplaires' => 'required',
        ]);

        try {
            $id_personnel = Personnel::all()->where('id_utilisateur', Auth::user()->id_utilisateur)->first()->id_personnel;
            $ouvrages = Ouvrage::whereIn('id_ouvrage', $validated_data['ids_ouvrages'])->get();
            
            for($i=0; $i <= count($validated_data['ids_ouvrages'])-1; $i++){
                $id_ouvrage =  $validated_data['ids_ouvrages'][$i];
                $nombre_exemplaire =  $validated_data['nombres_exemplaires'][$i];
    
                $ouvrage = $ouvrages->find($id_ouvrage);
                $ouvrage->augmenterNombreExemplaire($nombre_exemplaire);
                $ouvrage->save();
    
                Approvisionnement::create([
                    'nombre_exemplaire' => $nombre_exemplaire,
                    'id_personnel' => $id_personnel,
                    'id_ouvrage' => $id_ouvrage,
                ]);
            }
    
            return redirect()->route('approvisionnements.index')->with('success', 'Approvisionnement enregistré avec succès.');
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function show(Approvisionnement $approvisionnement)
    {
        return "Consultation";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Approvisionnement $approvisionnement)
    {
        try {
            return view('approvisionnements.create')->with([
                "ouvrages" => Ouvrage::all(),
                "approvisionnement" => $approvisionnement,
            ]);
        } catch (\Throwable $th) {
            abort(500, "");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approvisionnement $approvisionnement)
    {
        try {
            $delta = $request->nombre_exemplaire - $approvisionnement->nombre_exemplaire;
            $approvisionnement->ouvrage->augmenterNombreExemplaire($delta);
            $approvisionnement->ouvrage->save();

            $approvisionnement->nombre_exemplaire= $request->nombre_exemplaire;
            $approvisionnement->save();

            return redirect()->route('approvisionnements.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
        abort(500, "");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approvisionnement $approvisionnement)
    {
        $approvisionnement->ouvrage->augmenterNombreExemplaire($approvisionnement->nombre_exemplaire * -1);
        $approvisionnement->delete();
        return redirect()->route('approvisionnements.index')->with('success', 'Approvisionnement supprimé avec succès.');
    }
}
