<?php

namespace App\Http\Livewire\Ouvrage;

use App\Models\LivresNumerique;
use App\Models\LivresPapier;
use App\Service\LivresNumeriqueService;
use App\Service\LivresPapierService;
use App\Service\OuvrageService;
use Livewire\Component;

class IndexLivreNumeriqueLivewire extends Component
{
    public $search ;
    public $id_livre_numerique ;
    public $annees ;

    public $langues ;
    public $types ;
    public $categories ;
    public $niveaus ;

    public $annee_debut;
    public $annee_fin ;
    public $langue ;
    public $type ;
    public $categorie ;
    public $niveau ;
    public $par_page=20;

    public function searchByParameters()
    {

        $annees = OuvrageService::convertAnneeForResearch($this->annee_debut, $this->annee_fin, $this->annees);

        $this->id_livre_numerique = LivresNumeriqueService::searchByParamaters(
            $annees[0],
            $annees[1],
            $this->langue,
            $this->niveau,
            $this->type,
            $this->categorie,
            $this->search,
        );
    }

    public function searchByAll()
    {
        $this->searchByParameters();
    }

    public function render()
    {
        //dd(LivresNumerique::whereIn('id_livre_numerique', $this->id_livre_numerique)->get());
        return view('livewire.ouvrage.index-livre-numerique-livewire')->with([
            'livresNumeriques' => LivresNumerique::whereIn('id_livre_numerique', $this->id_livre_numerique)->paginate($this->par_page)
        ]);
    }
}
