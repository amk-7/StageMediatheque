<?php

namespace App\Http\Livewire\Approvisionement;

use Livewire\Component;

class Create extends Component
{
    public $ouvragesPhysique;
    public $personnels;

    public function render()
    {
        return view('livewire.approvisionement.create')->with([
            "ouvragesPhysique"=>$this->ouvragesPhysique,
            "personnel"=>$this->personnels
        ]);
    }
}
