<?php

namespace App\Http\Livewire\Approvisionement;

use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $ouvragesPhysique;
    public $personnels;
    public $selected_id_personnel = null;
    public $prenoms = array("allo", "je") ;


    public function update_liste_prenoms()
    {
        //dd($this->personnel);
        /*foreach ($this->personnels as $personnel){
            $prenom = $personnel->utilisateur->prenom;
            if($prenom==""){
               array_push( $this->prenoms, $prenom);
            }
        }*/
    }

    public function render()
    {
        return view('livewire.approvisionement.create');
    }
}
