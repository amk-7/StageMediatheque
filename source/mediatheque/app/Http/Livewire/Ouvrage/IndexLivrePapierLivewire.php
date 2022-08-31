<?php

namespace App\Http\Livewire\Ouvrage;

use App\Service\LivresPapierService;
use Livewire\Component;

class IndexLivrePapierLivewire extends Component
{
    public $titre = "temps";
    //public $livresPapiers;

    public function searchBy()
    {
        $this->livresPapiers= LivresPapierService::searchByTitre($this->titre);
    }

    public function render()
    {
        return view('livewire.ouvrage.index-livre-papier-livewire')->with([
            "livresPapiers"=>LivresPapierService::searchByTitre($this->titre)
        ]);
    }
}
