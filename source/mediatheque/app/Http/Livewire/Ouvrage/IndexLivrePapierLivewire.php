<?php

namespace App\Http\Livewire\Ouvrage;

use App\Service\LivresPapierService;
use Livewire\Component;

class IndexLivrePapierLivewire extends Component
{
    public $search;
    public $livresPapiers;

    public function render()
    {
        return view('livewire.ouvrage.index-livre-papier-livewire');
    }
}
