<?php

namespace App\Http\Livewire\Ouvrage;

use App\Models\LivresPapier;
use App\Service\LivresPapierService;
use App\Service\OuvrageService;
use Livewire\Component;

class IndexLivrePapierLivewire extends Component
{
    public $search ;
    public $id_livre_papier ;
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
    public $par_page=5;

    public function searchByParameters()
    {

        $annees = OuvrageService::convertAnneeForResearch($this->annee_debut, $this->annee_fin, $this->annees);

        $this->id_livre_papier = LivresPapierService::searchByParamaters(
            $annees[0],
            $annees[1],
            $this->langue,
            $this->niveau,
            $this->type,
            $this->categorie
        );
    }

    public function searchByAll()
    {
        if (! empty($this->search)){
            $this->id_livre_papier = LivresPapierService::searchByTitreMotCleISBN($this->search);
        }else{
            $this->searchByParameters();
        }

    }

    public function render()
    {
        //dd(LivresPapierService::searchByTitre($this->search));
        return view('livewire.ouvrage.index-livre-papier-livewire')->with([
            'livresPapiers' => LivresPapier::whereIn('id_livre_papier', $this->id_livre_papier)->paginate($this->par_page)
        ]);
    }
    //'livresPapiers' => LivresPapierService::searchByTitre($this->search)->paginate(5)
}
